<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderStatusLog extends Model
{
    protected $fillable = [
        'orderable_type', 'orderable_id',
        'status', 'changed_by_type', 'changed_by_id', 'notes',
    ];

    public function orderable()
    {
        return $this->morphTo();
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by_id');
    }
}
