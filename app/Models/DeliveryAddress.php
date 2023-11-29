<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'deliveredBy',
        'deliveryDateTime',
        'mode',
        'observations',
        'street_name',
        'street_number',
        'formatted_address',
        'neighborhood',
        'complement',
        'postal_code',
        'city',
        'state',
        'country',
        'reference',
        'latitude',
        'longitude',
        'pickupCode',
    ];

    protected $casts = [
        'deliveryDateTime' => 'datetime',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
