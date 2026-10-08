<?php

namespace App\Models;

use Database\Factories\PaymentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /** @use HasFactory<PaymentFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'order_id',
        'provider',
        'payment_method',
        'transaction_reference',
        'amount',
        'status',
        'paid_at',
        'metadata',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'paid_at' => 'datetime',
            'metadata' => 'array',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function formattedAmount(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }

    public function statusLabel(): string
    {
        return match ($this->status) {
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Lunas',
            'failed' => 'Gagal',
            'expired' => 'Kedaluwarsa',
            'refunded' => 'Dikembalikan',
            default => ucfirst($this->status),
        };
    }

    public function statusBadgeClass(): string
    {
        return match ($this->status) {
            'paid' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
            'failed', 'expired' => 'bg-rose-50 text-rose-700 border-rose-200',
            'refunded' => 'bg-purple-50 text-purple-700 border-purple-200',
            default => 'bg-stone-50 text-stone-700 border-stone-200',
        };
    }
}
