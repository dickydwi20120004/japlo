<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'user_id',
        'driver_id',
        'rating', // 1-5
        'review',
        'service_rating', // Rating untuk layanan
        'cleanliness_rating', // Rating untuk kebersihan
        'punctuality_rating', // Rating untuk ketepatan waktu
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rating' => 'integer',
        'service_rating' => 'integer',
        'cleanliness_rating' => 'integer',
        'punctuality_rating' => 'integer',
    ];

    /**
     * Relationship dengan Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

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
     * Boot method untuk update rating driver setelah rating dibuat
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($rating) {
            $driver = Driver::where('user_id', $rating->driver_id)->first();
            if ($driver) {
                $driver->updateRating();
            }
        });
    }
}
