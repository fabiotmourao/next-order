<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderDetailsController extends Controller
{
    public function getOrders()
    {
        // Recupere os dados do banco de dados
        $orders = Order::with(['customer', 'orderItems', 'deliveryAddress', 'orderEvents'])->get();

        // Retorne os dados como JSON
        return response()->json(['orders' => $orders]);
    }
}
