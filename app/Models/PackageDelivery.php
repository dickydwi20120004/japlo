<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'driver_id', 'delivery_number',
        'sender_name', 'sender_phone', 'pickup_address',
        'pickup_latitude', 'pickup_longitude',
        'recipient_name', 'recipient_phone', 'destination_address',
        'destination_latitude', 'destination_longitude',
        'package_type', 'package_description', 'weight',
        'special_notes', 'fragile', 'distance', 'price',
        'payment_method', 'payment_status', 'status',
        'cancellation_reason', 'delivered_at', 'cancelled_at',
    ];

    protected $casts = [
        'pickup_latitude'       => 'decimal:8',
        'pickup_longitude'      => 'decimal:8',
        'destination_latitude'  => 'decimal:8',
        'destination_longitude' => 'decimal:8',
        'weight'                => 'decimal:2',
        'distance'              => 'decimal:2',
        'price'                 => 'decimal:2',
        'fragile'               => 'boolean',
        'delivered_at'          => 'datetime',
        'cancelled_at'          => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function statusLogs()
    {
        return $this->morphMany(OrderStatusLog::class, 'orderable');
    }

    public static function generateDeliveryNumber(): string
    {
        $date = now()->format('Ymd');
        $last = static::whereDate('created_at', today())->latest()->first();
        $num  = $last ? intval(substr($last->delivery_number, -4)) + 1 : 1;
        return 'PKT' . $date . str_pad($num, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Hitung harga fallback jika tarif DB tidak ditemukan
     */
    public static function calculatePrice(float $distance, string $vehicleType = 'motor'): float
    {
        $baseFare = $vehicleType === 'mobil' ? 12000 : 7000;
        $perKm    = $vehicleType === 'mobil' ? 6000  : 3500;
        $minimum  = $vehicleType === 'mobil' ? 18000 : 10000;
        $price    = $baseFare + ($distance * $perKm);
        return round(max($price, $minimum), -2);
    }

    public function scopeActive($query)
    {
        return $query->whereIn('status', ['pending', 'accepted', 'picked_up', 'in_transit']);
    }

    public static function getPackageTypes(): array
    {
        return [
            'dokumen'       => 'Dokumen / Surat',
            'paket_kecil'   => 'Paket Kecil (< 1kg)',
            'paket_sedang'  => 'Paket Sedang (1–5kg)',
            'paket_besar'   => 'Paket Besar (> 5kg)',
        ];
    }
}
