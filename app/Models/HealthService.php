<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthService extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'full_description', 'icon', 'image',
        'price', 'provider', 'phone', 'benefits', 'how_it_works',
        'is_available', 'sort_order',
    ];

    protected $casts = [
        'price'        => 'decimal:2',
        'benefits'     => 'array',
        'how_it_works' => 'array',
        'is_available' => 'boolean',
        'sort_order'   => 'integer',
    ];

    public function scopeAvailable($query)
    {
        return $query->where('is_available', true)->orderBy('sort_order');
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
