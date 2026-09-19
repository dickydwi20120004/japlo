<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpoRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'expo_name', 'business_name', 'owner_name',
        'phone', 'email', 'business_type', 'product_description',
        'booth_size', 'booth_price', 'ktp_photo', 'business_photo',
        'special_request', 'status', 'admin_notes', 'approved_at',
    ];

    protected $casts = [
        'booth_size'  => 'integer',
        'booth_price' => 'decimal:2',
        'approved_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
