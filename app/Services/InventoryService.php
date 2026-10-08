<?php

namespace App\Services;

use App\Models\InventoryMovement;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class InventoryService
{
    /**
     * Record inventory movement and adjust variant stock atomically.
     *
     * @param  int  $quantity  Quantity moved (positive integer)
     * @param  string  $type  'in' | 'out' | 'adjustment' | 'return'
     */
    public function recordMovement(
        ProductVariant $variant,
        int $quantity,
        string $type,
        ?int $userId = null,
        ?string $note = null,
        ?string $referenceType = null,
        ?int $referenceId = null
    ): InventoryMovement {
        if (! in_array($type, ['in', 'out', 'adjustment', 'return'], true)) {
            throw new InvalidArgumentException("Invalid inventory movement type: {$type}");
        }

        return DB::transaction(function () use ($variant, $quantity, $type, $userId, $note, $referenceType, $referenceId) {
            $currentStock = $variant->stock_qty;

            $newStock = match ($type) {
                'in', 'return' => $currentStock + abs($quantity),
                'out' => max(0, $currentStock - abs($quantity)),
                'adjustment' => max(0, $quantity),
            };

            $movementQuantity = ($type === 'adjustment')
                ? ($newStock - $currentStock)
                : abs($quantity);

            $variant->update(['stock_qty' => $newStock]);

            return InventoryMovement::create([
                'product_variant_id' => $variant->id,
                'type' => $type,
                'quantity' => $movementQuantity,
                'reference_type' => $referenceType,
                'reference_id' => $referenceId,
                'note' => $note,
                'created_by' => $userId,
            ]);
        });
    }

    /**
     * Explicitly set stock quantity with an adjustment movement.
     */
    public function setStock(
        ProductVariant $variant,
        int $newStock,
        ?int $userId = null,
        ?string $note = null
    ): InventoryMovement {
        return $this->recordMovement(
            variant: $variant,
            quantity: max(0, $newStock),
            type: 'adjustment',
            userId: $userId,
            note: $note ?? 'Manual stock adjustment from admin panel'
        );
    }
}
