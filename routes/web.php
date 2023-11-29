<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IfoodController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ConfiguracoesController;

Route::get('/', function () {
    return view('dashboard');
});

Route::any('/process-order-events', [IfoodController::class, 'processOrderEvents']);

Route::get('/orders', [OrderDetailsController::class, 'index']);

Route::get('/configuracoes', [ConfiguracoesController::class, 'index']);

