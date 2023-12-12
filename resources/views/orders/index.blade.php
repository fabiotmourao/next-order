@extends('layout.app')

@section('content')
    <h5 class="card-header">Lista de Pedidos</h5>
    <div class="card-body p-3 mb-5 bg-body rounded">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pendentes-tab" data-bs-toggle="tab" data-bs-target="#pendentes"
                    type="button" role="tab" aria-controls="pendentes" aria-selected="true">Pendentes</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="preparo-tab" data-bs-toggle="tab" data-bs-target="#preparo" type="button"
                    role="tab" aria-controls="preparo" aria-selected="false">Em preparo</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="finalizados-tab" data-bs-toggle="tab" data-bs-target="#finalizados"
                    type="button" role="tab" aria-controls="finalizados" aria-selected="false">Finalizados</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="pendentes" role="tabpanel" aria-labelledby="pendentes-tab">

                <div class="card-body shadow-sm p-3 mb-5 bg-body rounded">
                    @if (count($orders) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Nº Pedido</th>
                                        <th scope="col">Feito em</th>
                                        <th scope="col">Tipo de Pedido</th>
                                        <th scope="col">Status do pedido</th>
                                        <th scope="col">Detalhar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <th scope="row"># {{ $order->display_id }}</th>
                                            <td>
                                                {{ Carbon\Carbon::parse($order->order_created_at)->format('d/m/Y') }} -
                                                {{ Carbon\Carbon::parse($order->order_created_at)->format('H:i:s') }}
                                            </td>
                                            <td>{{ $order->order_type }}</td>
                                            <td id="status_{{ $order->id }}">
                                                <span class="px-1 border border-2  bg-opacity-25 rounded-pill">
                                                    {{ $order->orderEvents->first()->full_code }}
                                                </span>
                                            </td>
                                            <td>
                                                <button type="button" class="btn " data-bs-toggle="offcanvas"
                                                    data-bs-target="#orderOffcanvas{{ $order->id }}"
                                                    aria-controls="orderOffcanvas{{ $order->id }}">
                                                    <x-carbon-view style="width: 24px; height: 24px;" />
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @foreach ($orders as $order)
                            @include('orders.partials.order_pending_offcanvas', ['order' => $order])
                        @endforeach
                    @else
                        <p>Não há pedidos disponíveis no momento.</p>
                    @endif
                </div>
            </div>
            {{-- <div class="tab-pane fade" id="preparo" role="tabpanel" aria-labelledby="preparo-tab">
                <div class="card-body shadow-sm p-3 mb-5 bg-body rounded">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nº Pedido Aceitos</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordersPreparation as $orderPreparation)
                                    <tr>
                                        <th scope="row"># {{ $orderPreparation->display_id }}</th>
                                        <td>
                                            {{ Carbon\Carbon::parse($orderPreparation->order_created_at)->format('d/m/Y') }} -
                                            {{ Carbon\Carbon::parse($orderPreparation->order_created_at)->format('H:i') }}
                                        </td>
                                        <td>{{ $orderPreparation->order_type }}</td>
                                        <td>
                                            <span
                                                class="px-1 border border-2 border-success text-success bg-success bg-opacity-50 rounded-pill">
                                                {{ $orderPreparation->orderEvents->first()->full_code }}
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn " data-bs-toggle="offcanvas"
                                                data-bs-target="#orderOffcanvas{{ $orderPreparation->id }}"
                                                aria-controls="orderOffcanvas{{ $orderPreparation->id }}">
                                                <x-carbon-view style="width: 24px; height: 24px;" />
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    @foreach ($ordersPreparation as $orderPreparation)
                        @include('orders.partials.order_preparation_offcanvas', ['orderPreparation' => $orderPreparation])
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="finalizados" role="tabpanel" aria-labelledby="finalizados-tab">
                <!-- Coloque o código da tabela aqui -->

                <div class="card-body shadow-sm p-3 mb-5 bg-body rounded">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Nº Pedido Finalizados</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ordersCompleted as $orderCompleted)
                                    <tr>
                                        <th scope="row"># {{ $orderCompleted->display_id }}</th>
                                        <td>
                                            {{ Carbon\Carbon::parse($orderCompleted->order_created_at)->format('d/m/Y') }} -
                                            {{ Carbon\Carbon::parse($orderCompleted->order_created_at)->format('H:i') }}
                                        </td>
                                        <td>{{ $orderCompleted->order_type }}</td>
                                        <td>
                                            <span
                                                class="px-1 border border-2 border-success text-success  bg-success bg-opacity-25 rounded-pill">
                                                {{ $orderCompleted->orderEvents->first()->full_code }}
                                            </span>
                                        </td>
                                        <td>
                                            <button type="button" class="btn " data-bs-toggle="offcanvas"
                                                data-bs-target="#orderOffcanvas{{ $orderCompleted->id }}"
                                                aria-controls="orderOffcanvas{{ $orderCompleted->id }}">
                                                <x-carbon-view style="width: 24px; height: 24px;" />
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @foreach ($ordersCompleted as $orderCompleted)
                        @include('orders.partials.order_finalized_offcanvas', ['orderCompleted' => $orderCompleted])
                    @endforeach
                </div>
            </div> --}}
        </div>
    </div>
@endsection
@section('scripts')
    <script type="module">
        Echo.channel(`order-events`).listen('.updateStatus', (data) => {
            console.log('Received event:', JSON.stringify(data));

            // var statusElement = document.getElementById('status_' + e.orderEvent.id);
            // if (statusElement) {
            //     statusElement.innerText = e.orderEvent.full_code;
            // }
        });
    </script>
@endsection
