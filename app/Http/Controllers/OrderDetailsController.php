<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderDetailsController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'orderItems', 'deliveryAddress', 'orderEvents'])->get();

        return view('orders.index', compact('orders'));
    }
}
