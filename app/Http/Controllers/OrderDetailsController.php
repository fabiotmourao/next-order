<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderDetailsController extends Controller
{
    public function getOrders()
    {
        // Recupere os dados do banco de dados
        $orders = Order::with(['customer', 'orderItems', 'deliveryAddress'])->get();

        // Retorne os dados como JSON para uma view
        return view('orders.index', compact('orders'));
    }
}