<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_id_external',
        'code',
        'full_code',
        'order_id',
        'event_created_at',
        'metadata'
    ];

    protected $casts = [
        'metadata' => 'json'
    ];
}
