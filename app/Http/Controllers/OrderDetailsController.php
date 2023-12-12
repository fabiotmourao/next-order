<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Helpers\CustomFuncs;
use App\Services\IfoodService;
use App\Events\OrderEventUpdated;

class OrderDetailsController extends Controller
{

    public function indexTeste()
    {

        OrderEventUpdated::dispatch(['0'=>'fabio lindo', '1'=>'caio feio']);

        return view('index');
    }

    public function index()
    {
        $orders = Order::with(['customer', 'orderItems', 'deliveryAddress', 'orderEvents'])->get();


        // $orders = Order::with(['customer', 'orderItems', 'deliveryAddress', 'orderEvents'])
        //     ->whereHas('orderEvents', function ($query) {
        //         $query->where('full_code', 'PLACED');
        //     })
        //     ->get();

        // $ordersPreparation = Order::with(['customer', 'orderItems', 'deliveryAddress', 'orderEvents'])
        //     ->whereHas('orderEvents', function ($query) {
        //         $query->where('full_code', 'CONFIRMED');
        //     })
        //     ->get();

        // $ordersCompleted = Order::with(['customer', 'orderItems', 'deliveryAddress', 'orderEvents'])
        //     ->whereHas('orderEvents', function ($query) {
        //         $query->whe                    re('full_code', 'CONCLUDED');
        //     })
        //     ->get();

        // $orders = Order::with(['customer', 'orderItems', 'deliveryAddress', 'orderEvents'])
        //     ->whereHas('orderEvents', function ($query) {
        //         $query->whereIn('full_code', ['PLACED', 'CONFIRMED']);
        //     })
        //     ->get();

        // $ordersPreparation = Order::with(['customer', 'orderItems', 'deliveryAddress', 'orderEvents'])
        //     ->whereHas('orderEvents', function ($query) {
        //         $query->whereIn('full_code', ['PREPARATION_STARTED', 'CONFIRMED']);
        //     })
        //     ->get();

        // $ordersCompleted = Order::with(['customer', 'orderItems', 'deliveryAddress', 'orderEvents'])
        //     ->whereHas('orderEvents', function ($query) {
        //         $query->where('full_code', 'CONCLUDED');
        //     })
        //     ->get();

        return view('orders.index', compact('orders'));
    }

    public function confirmOrder($orderId)
    {
        $ifoodService = new IfoodService();
        $response = $ifoodService->confirmOrder($orderId);

        if ($response) {
            // Pedido confirmado com sucesso
            session()->flash('status_' . $orderId, 'Pedido confirmado com sucesso!');
        } else {
            // Falha ao confirmar o pedido
            session()->flash('status_' . $orderId, 'Falha ao confirmar o pedido!');
        }

        return redirect()->back();
    }
}
