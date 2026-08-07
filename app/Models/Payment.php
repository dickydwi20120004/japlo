<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'transaction_id',
        'payment_method',
        'payment_status',
        'subtotal',
        'shipping',
        'tax',
        'total_amount',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'city',
        'province',
        'postal_code',
        'paid_at',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping' => 'decimal:2',
        'tax' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_at' => 'datetime',
    ];

    /**
     * Relationship dengan Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relationship dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate transaction ID
     */
    public static function generateTransactionId()
    {
        return 'TXN-' . time() . '-' . mt_rand(1000, 9999);
    }

    /**
     * Mark payment as success
     */
    public function markAsSuccess()
    {
        $this->update([
            'payment_status' => 'success',
            'paid_at' => now(),
        ]);

        // Update order payment status
        if ($this->order) {
            $this->order->update(['payment_status' => 'paid']);
        }
    }

    /**
     * Mark payment as failed
     */
    public function markAsFailed()
    {
        $this->update(['payment_status' => 'failed']);
    }

    /**
     * Scope untuk mencari by transaction ID
     */
    public function scopeByTransactionId($query, $transactionId)
    {
        return $query->where('transaction_id', $transactionId);
    }

    /**
     * Scope untuk filter by status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('payment_status', $status);
    }
}
