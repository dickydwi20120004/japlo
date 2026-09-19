<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'description', 'price', 'original_price',
        'stock', 'category', 'image', 'weight', 'rating', 'sold_count', 'is_active',
    ];

    protected $casts = [
        'price'          => 'decimal:2',
        'original_price' => 'decimal:2',
        'weight'         => 'decimal:2',
        'rating'         => 'decimal:2',
        'stock'          => 'integer',
        'sold_count'     => 'integer',
        'is_active'      => 'boolean',
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->where('stock', '>', 0);
    }

    public function getDiscountPercentAttribute()
    {
        if ($this->original_price && $this->original_price > $this->price) {
            return round((($this->original_price - $this->price) / $this->original_price) * 100);
        }
        return 0;
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('images/placeholder-product.png');
    }
}
