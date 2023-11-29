<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ConfiguracoesController extends Controller
{
    public function index() {
        return view('configuracoes.index');
    }
}
