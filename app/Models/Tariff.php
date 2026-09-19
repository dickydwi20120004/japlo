<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tariff extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_type', 'label', 'base_fare',
        'per_km', 'minimum_fare', 'platform_fee', 'is_active',
    ];

    protected $casts = [
        'base_fare'    => 'decimal:2',
        'per_km'       => 'decimal:2',
        'minimum_fare' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'is_active'    => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Hitung tarif berdasarkan jarak
     */
    public function calculate(float $distanceKm): float
    {
        $price = $this->base_fare + ($distanceKm * $this->per_km);
        $price = max($price, $this->minimum_fare);
        return round($price, -2); // round ke ratusan terdekat
    }

    /**
     * Ambil tarif aktif by service type
     */
    public static function getActive(string $serviceType): ?self
    {
        return static::where('service_type', $serviceType)
            ->where('is_active', true)
            ->first();
    }
}
