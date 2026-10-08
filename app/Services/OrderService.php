<?php

namespace App\Services;

use App\Exceptions\InvalidOrderStateTransitionException;
use App\Models\InventoryMovement;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class OrderService
{
    /**
     * Allowed status transitions for an Order.
     */
    public const ALLOWED_TRANSITIONS = [
        'pending' => ['confirmed', 'cancelled'],
        'confirmed' => ['processing', 'cancelled'],
        'processing' => ['packed', 'cancelled'],
        'packed' => ['shipped', 'cancelled'],
        'shipped' => ['delivered'],
        'delivered' => ['completed'],
        'completed' => [],
        'cancelled' => [],
    ];

    public function __construct(
        protected InventoryService $inventoryService,
    ) {}

    /**
     * Check if status transition is permissible according to state machine.
     */
    public function canTransition(string $from, string $to): bool
    {
        $allowed = self::ALLOWED_TRANSITIONS[$from] ?? [];

        return in_array($to, $allowed, true);
    }

    /**
     * Transition order to a new state with validation.
     *
     * @throws InvalidOrderStateTransitionException
     */
    public function transitionStatus(Order $order, string $newStatus, ?string $reason = null, ?User $actor = null): Order
    {
        if ($order->status === $newStatus) {
            return $order;
        }

        if (! $this->canTransition($order->status, $newStatus)) {
            throw new InvalidOrderStateTransitionException($order->status, $newStatus);
        }

        if ($newStatus === 'cancelled') {
            return $this->cancelOrder($order, $reason, $actor);
        }

        $order->update(['status' => $newStatus]);

        return $order->fresh();
    }

    /**
     * Cancel an order and restore inventory atomically and idempotently.
     */
    public function cancelOrder(Order $order, ?string $reason = null, ?User $actor = null): Order
    {
        // 1. Idempotency check: if already cancelled, return immediately without restoring stock twice
        if ($order->status === 'cancelled') {
            return $order;
        }

        // 2. Validate cancellable states (cannot cancel once shipped, delivered, or completed)
        $cancellableStatuses = ['pending', 'confirmed', 'processing', 'packed'];
        if (! in_array($order->status, $cancellableStatuses, true)) {
            throw new InvalidArgumentException("Pesanan dengan status '{$order->statusLabel()}' tidak dapat dibatalkan.");
        }

        return DB::transaction(function () use ($order, $reason, $actor) {
            // Restore product variant stock for each ordered item
            $order->loadMissing('items.variant');

            foreach ($order->items as $item) {
                $variant = $item->variant;
                if (! $variant) {
                    continue;
                }

                // Guard against duplicate stock restoration
                $alreadyReturned = InventoryMovement::where('reference_type', Order::class)
                    ->where('reference_id', $order->id)
                    ->where('product_variant_id', $variant->id)
                    ->where('type', 'return')
                    ->exists();

                if (! $alreadyReturned) {
                    $note = "Pengembalian stok pembatalan pesanan #{$order->order_number}";
                    if ($reason) {
                        $note .= " ({$reason})";
                    }

                    $this->inventoryService->recordMovement(
                        variant: $variant,
                        quantity: $item->quantity,
                        type: 'return',
                        userId: $actor?->id,
                        note: $note,
                        referenceType: Order::class,
                        referenceId: $order->id,
                    );
                }
            }

            $order->update([
                'status' => 'cancelled',
            ]);

            return $order->fresh();
        });
    }
}
