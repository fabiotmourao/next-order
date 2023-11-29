<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id_external',
        'delivery',
        'order_type',
        'order_timing',
        'display_id',
        'order_created_at',
        'preparation_start_date_time',
        'is_test',
        'customer_id',

    ];


    protected $casts = [
        'delivery' => 'json',
        'preparation_start_date_time' => 'datetime'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function token()
    {
        return $this->belongsTo(Token::class, 'order_id', 'id');
    }

    public function deliveryAddress()
    {
        return $this->hasOne(DeliveryAddress::class, 'order_id', 'id');
    }

    public function orderEvents()
    {
        return $this->hasMany(OrderEvent::class, 'order_id', 'order_id_external');
    }
}
