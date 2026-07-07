<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role', // 'user' atau 'driver'
        'profile_photo',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Relationship dengan Driver
     */
    public function driver()
    {
        return $this->hasOne(Driver::class);
    }

    /**
     * Relationship dengan Orders sebagai customer
     */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    /**
     * Relationship dengan Orders sebagai driver
     */
    public function driverOrders()
    {
        return $this->hasMany(Order::class, 'driver_id');
    }

    /**
     * Relationship dengan Ratings sebagai customer
     */
    public function givenRatings()
    {
        return $this->hasMany(Rating::class, 'user_id');
    }

    /**
     * Relationship dengan Ratings sebagai driver
     */
    public function receivedRatings()
    {
        return $this->hasMany(Rating::class, 'driver_id');
    }

    /**
     * Check apakah user adalah driver
     */
    public function isDriver()
    {
        return $this->role === 'driver';
    }

    /**
     * Check apakah user adalah customer
     */
    public function isCustomer()
    {
        return $this->role === 'user';
    }
}
