<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'category', 'description', 'address', 'phone',
        'image', 'rating', 'latitude', 'longitude', 'open_time', 'close_time',
        'min_order', 'delivery_time', 'is_open', 'is_active',
    ];

    protected $casts = [
        'rating'        => 'decimal:2',
        'latitude'      => 'decimal:8',
        'longitude'     => 'decimal:8',
        'min_order'     => 'decimal:2',
        'delivery_time' => 'integer',
        'is_open'       => 'boolean',
        'is_active'     => 'boolean',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function activeMenus()
    {
        return $this->hasMany(Menu::class)->where('is_available', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/placeholder-restaurant.png');
    }
}
