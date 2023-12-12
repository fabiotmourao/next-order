<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Events\OrderEventUpdated;

class OrderEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'full_code',
        'order_id',
        'event_created_at',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'json'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id_external', 'order_id');
    }
}
