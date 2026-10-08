<?php

namespace App\Models;

use Database\Factories\AddressFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    /** @use HasFactory<AddressFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'label',
        'recipient_name',
        'phone',
        'address_line',
        'village',
        'district',
        'city',
        'province',
        'postal_code',
        'notes',
        'is_default',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_default' => 'boolean',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function fullAddress(): string
    {
        $parts = array_filter([
            $this->address_line,
            $this->village ? 'Kel. '.$this->village : null,
            $this->district ? 'Kec. '.$this->district : null,
            $this->city,
            $this->province,
            $this->postal_code,
        ]);

        return implode(', ', $parts);
    }
}
