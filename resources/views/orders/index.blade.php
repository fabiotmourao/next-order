@extends('layout.app')

@section('content')
    <h5 class="card-header">Lista de Pedidos</h5>
    <div class="card-body">
        <div class="table-responsive ">

            <table class="table shadow-sm p-3 mb-5 bg-body rounded">
                <thead>
                    <tr>
                        <th scope="col">Nº Pedido</th>
                        <th scope="col">Feito em</th>
                        <th scope="col">Tipo de Pedido</th>
                        <th scope="col">Status</th>
                        <th class="text-center" scope="col">Detalhar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <th scope="row"># {{ $order->display_id }}</th>
                            <td>{{ Carbon\Carbon::parse($order->order_created_at)->format('d/m/Y') }} as
                                {{ Carbon\Carbon::parse($order->order_created_at)->format('H:i:s') }}</td>
                            <td>{{ $order->order_type }}</td>
                            <td>{{ $order->orderEvents->first()->full_code ? 'Novo pedido na plataforma' : '' }} </td>
                            <td class="text-center">
                                <a href="#" data-toggle="modal" data-target="#orderModal{{ $order->id }}">
                                    <x-carbon-view style="width: 24px; height: 24px; color: #000" />
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Modais para cada pedido -->
        @foreach ($orders as $order)
            @include('orders.partials.order_modal', ['order' => $order])
        @endforeach
    </div>
@endsection
