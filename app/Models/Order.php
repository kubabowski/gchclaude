<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'customer_name',
        'customer_email',
        'product_name',
        'quantity',
        'unit_price',
        'total_amount',
        'currency',
        'status',
        'p24_order_id',
        'p24_token',
    ];

    protected $casts = [
        'unit_price'   => 'integer', // w groszach
        'total_amount' => 'integer', // w groszach
        'quantity'     => 'integer',
    ];

    public function getTotalFormattedAttribute(): string
    {
        return number_format($this->total_amount / 100, 2, ',', ' ') . ' PLN';
    }

    public function getUnitFormattedAttribute(): string
    {
        return number_format($this->unit_price / 100, 2, ',', ' ') . ' PLN';
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }
}
