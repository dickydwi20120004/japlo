<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'description', 'image', 'category', 'type',
        'discount_value', 'discount_type', 'promo_code', 'quota',
        'used_count', 'min_purchase', 'start_date', 'end_date', 'is_active',
    ];

    protected $casts = [
        'discount_value' => 'decimal:2',
        'min_purchase'   => 'decimal:2',
        'quota'          => 'integer',
        'used_count'     => 'integer',
        'start_date'     => 'date',
        'end_date'       => 'date',
        'is_active'      => 'boolean',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            });
    }

    public function getIsExpiredAttribute()
    {
        return $this->end_date && $this->end_date->lt(now());
    }

    public function getIsQuotaFullAttribute()
    {
        return $this->quota && $this->used_count >= $this->quota;
    }

    public function getImageUrlAttribute()
    {
        if ($this->image && str_starts_with($this->image, 'http')) {
            return $this->image;
        }
        return $this->image
            ? asset('storage/' . $this->image)
            : null;
    }
}
