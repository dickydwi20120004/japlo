<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'market_order_id', 'item_name', 'description',
        'quantity', 'unit', 'estimated_price', 'actual_price',
    ];

    protected $casts = [
        'quantity'        => 'integer',
        'estimated_price' => 'decimal:2',
        'actual_price'    => 'decimal:2',
    ];

    public function marketOrder()
    {
        return $this->belongsTo(MarketOrder::class);
    }
}
