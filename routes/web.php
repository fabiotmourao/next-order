<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IfoodController;
use App\Http\Controllers\OrderDetailsController;

Route::get('/', function () {
    return view('welcome');
});

Route::any('/process-order-events', [IfoodController::class, 'processOrderEvents']);

Route::get('/orders', [OrderDetailsController::class, 'getOrders']);
