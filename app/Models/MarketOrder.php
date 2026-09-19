<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'driver_id', 'order_number', 'market_name',
        'delivery_address', 'notes', 'estimated_price', 'actual_price',
        'delivery_fee', 'service_fee', 'total', 'payment_method',
        'payment_status', 'status', 'delivered_at',
    ];

    protected $casts = [
        'estimated_price' => 'decimal:2',
        'actual_price'    => 'decimal:2',
        'delivery_fee'    => 'decimal:2',
        'service_fee'     => 'decimal:2',
        'total'           => 'decimal:2',
        'delivered_at'    => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function items()
    {
        return $this->hasMany(MarketOrderItem::class);
    }

    public static function generateOrderNumber(): string
    {
        $date = now()->format('Ymd');
        $last = static::whereDate('created_at', today())->latest()->first();
        $num  = $last ? intval(substr($last->order_number, -4)) + 1 : 1;
        return 'PSR' . $date . str_pad($num, 4, '0', STR_PAD_LEFT);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'accepted', 'shopping', 'on_the_way']);
    }
}
