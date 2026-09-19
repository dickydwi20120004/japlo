<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitraRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'business_name', 'owner_name', 'phone', 'email',
        'address', 'business_type', 'business_description',
        'ktp_photo', 'business_photo', 'membership_tier',
        'status', 'admin_notes', 'approved_at',
    ];

    protected $casts = [
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

    public static function getBusinessTypes(): array
    {
        return [
            'kuliner'    => 'Kuliner & Makanan',
            'produk'     => 'Produk & Barang',
            'jasa'       => 'Jasa & Layanan',
            'kesehatan'  => 'Kesehatan & Kecantikan',
            'pendidikan' => 'Pendidikan & Kursus',
            'lainnya'    => 'Lainnya',
        ];
    }

    public static function getMembershipTiers(): array
    {
        return [
            'reguler'  => ['label' => 'Reguler',  'price' => 0,       'color' => '#6B7280'],
            'perunggu' => ['label' => 'Perunggu', 'price' => 300000,  'color' => '#CD7F32'],
            'perak'    => ['label' => 'Perak',    'price' => 750000,  'color' => '#94A3B8'],
            'emas'     => ['label' => 'Emas',     'price' => 1500000, 'color' => '#F59E0B'],
            'platinum' => ['label' => 'Platinum', 'price' => 5000000, 'color' => '#8B5CF6'],
        ];
    }
}
