<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'vehicle_type',
        'vehicle_brand',
        'license_plate', // updated from vehicle_number
        'vehicle_color',
        'license_number',
        'identity_number',
        'address', // new field
        'is_available',
        'is_verified',
        'current_latitude',
        'current_longitude',
        'rating',
        'total_rides',
        'total_earnings',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_available' => 'boolean',
        'is_verified' => 'boolean',
        'current_latitude' => 'decimal:8',
        'current_longitude' => 'decimal:8',
        'rating' => 'decimal:2',
        'total_rides' => 'integer',
        'total_earnings' => 'decimal:2',
    ];

    /**
     * Relationship dengan User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship dengan Orders
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'driver_id');
    }

    /**
     * Relationship dengan Ratings
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'driver_id');
    }

    /**
     * Update lokasi driver
     */
    public function updateLocation($latitude, $longitude)
    {
        $this->update([
            'current_latitude' => $latitude,
            'current_longitude' => $longitude,
        ]);
    }

    /**
     * Set driver availability
     */
    public function setAvailability($available)
    {
        $this->update([
            'is_available' => $available,
        ]);
    }

    /**
     * Update rating driver
     */
    public function updateRating()
    {
        $averageRating = $this->ratings()->avg('rating');
        $this->update([
            'rating' => round($averageRating, 2),
        ]);
    }

    /**
     * Increment total rides
     */
    public function incrementRides()
    {
        $this->increment('total_rides');
    }

    /**
     * Add earnings
     */
    public function addEarnings($amount)
    {
        $this->increment('total_earnings', $amount);
    }
}
