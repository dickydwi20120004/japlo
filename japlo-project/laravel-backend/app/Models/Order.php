<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'driver_id',
        'order_number',
        'pickup_address',
        'pickup_latitude',
        'pickup_longitude',
        'destination_address',
        'destination_latitude',
        'destination_longitude',
        'distance', // dalam kilometer
        'estimated_time', // dalam menit
        'price',
        'status', // pending, accepted, picked_up, in_progress, completed, cancelled
        'payment_method', // cash, ewallet
        'payment_status', // pending, paid
        'driver_notes',
        'customer_notes',
        'cancelled_by', // user atau driver
        'cancellation_reason',
        'completed_at',
        'cancelled_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'pickup_latitude' => 'decimal:8',
        'pickup_longitude' => 'decimal:8',
        'destination_latitude' => 'decimal:8',
        'destination_longitude' => 'decimal:8',
        'distance' => 'decimal:2',
        'estimated_time' => 'integer',
        'price' => 'decimal:2',
        'completed_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    /**
     * Relationship dengan User (customer)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relationship dengan Driver
     */
    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    /**
     * Relationship dengan Rating
     */
    public function rating()
    {
        return $this->hasOne(Rating::class);
    }

    /**
     * Generate order number
     */
    public static function generateOrderNumber()
    {
        $date = now()->format('Ymd');
        $lastOrder = self::whereDate('created_at', today())->latest()->first();
        $number = $lastOrder ? intval(substr($lastOrder->order_number, -4)) + 1 : 1;
        return 'JPL' . $date . str_pad($number, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Calculate price berdasarkan jarak
     */
    public static function calculatePrice($distance)
    {
        // Base fare: Rp 5000
        // Per KM: Rp 3000
        $baseFare = 5000;
        $perKm = 3000;
        $price = $baseFare + ($distance * $perKm);
        return round($price, -2); // Round ke ratusan terdekat
    }

    /**
     * Update status order
     */
    public function updateStatus($status)
    {
        $this->update(['status' => $status]);
        
        if ($status === 'completed') {
            $this->update(['completed_at' => now()]);
        }
    }

    /**
     * Cancel order
     */
    public function cancel($cancelledBy, $reason = null)
    {
        $this->update([
            'status' => 'cancelled',
            'cancelled_by' => $cancelledBy,
            'cancellation_reason' => $reason,
            'cancelled_at' => now(),
        ]);
    }

    /**
     * Assign driver ke order
     */
    public function assignDriver($driverId)
    {
        $this->update([
            'driver_id' => $driverId,
            'status' => 'accepted',
        ]);
    }

    /**
     * Scope untuk filter order berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk order yang sedang aktif
     */
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'accepted', 'picked_up', 'in_progress']);
    }
}
