{{-- <div class="modal" id="orderModal{{ $order->id }}" tabindex="-1" role="dialog"
    aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Detalhes do Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-4">
                            <span class="font-weight-bold">Pedido </span>
                            <p># {{ $order->display_id }}</p>
                            <span class="font-weight-bold">Feito em</span>
                            <p>
                                {{ Carbon\Carbon::parse($order->order_created_at)->format('d/m/Y') }} as
                                {{ Carbon\Carbon::parse($order->order_created_at)->format('H:i:s') }}
                            </p>
                            <span class="font-weight-bold">Tipo de pedido: </span>
                            <p>{{ $order->order_type }}</p>
                        </div>

                        <div class="col-8">
                            <span class="font-weight-bold">Entrega</span>
                            <div class='col-md-12 '>
                                <p>
                                    {{ $order->deliveryAddress->street_name }} -
                                    {{ $order->deliveryAddress->neighborhood }},
                                    {{ $order->deliveryAddress->formattedAddress }}
                                    {{ $order->deliveryAddress->street_number }},
                                    {{ $order->deliveryAddress->complement }}
                                </p>
                            </div>
                            <div class='col-md-12 '>
                                <span class="font-weight-bold">Itens do Pedido</span>

                                @foreach ($order->orderItems as $item)
                                        {{ $item->name }} -
                                        {{ $item->unit }} -
                                        {{ $item->quantity }}x,
                                        {{ $item->unit_price }}
                                        {{ $item->options_price }},
                                        {{ $item->total_price }},
                                        {{ $item->price }}
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Confirmar Pedido</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#orderModal').on('show.bs.modal', function(e) {
        $(this).addClass('show');
    })
</script> --}}
<div class="modal" id="orderModal{{ $order->id }}" tabindex="-1" role="dialog"
    aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">Detalhes do Pedido</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-3">
                            <span class="font-weight-bold">Pedido </span>
                            <p># {{ $order->display_id }}</p>
                            <span class="font-weight-bold">Feito em</span>
                            <p>
                                {{ Carbon\Carbon::parse($order->order_created_at)->format('d/m/Y') }} as
                                {{ Carbon\Carbon::parse($order->order_created_at)->format('H:i:s') }}
                            </p>
                            <span class="font-weight-bold">Tipo de pedido: </span>
                            <p>{{ $order->order_type }}</p>
                        </div>

                        <div class="col-9">
                            <span class="font-weight-bold">Entrega</span>
                            <div class=''>
                                <p>
                                    {{ $order->deliveryAddress->street_name }} -
                                    {{ $order->deliveryAddress->neighborhood }},
                                    {{ $order->deliveryAddress->formattedAddress }}
                                    {{ $order->deliveryAddress->street_number }},
                                    {{ $order->deliveryAddress->complement }}
                                </p>
                            </div>
                            <div class=''>
                                <span class="font-weight-bold">Itens do Pedido</span>
                                <table class="table shadow-sm p-3 mb-5 bg-body rounded">
                                    <thead>
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Unidade</th>
                                            <th scope="col">Quantidade</th>
                                            <th scope="col">Preço Unitário</th>
                                            <th scope="col">Preço das Opções</th>
                                            <th scope="col">Preço</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total_price = 0;
                                        @endphp
                                        @foreach ($order->orderItems as $item)
                                            @php
                                                $total_price += $item->quantity * $item->unit_price + $item->options_price;
                                            @endphp
                                            <tr>
                                                <td class="fs-6">{{ $item->name }}</td>
                                                <td>{{ $item->unit }}</td>
                                                <td>{{ $item->quantity }}x</td>
                                                <td>{{ $item->unit_price }}</td>
                                                <td>{{ $item->options_price }}</td>
                                                <td>{{ $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="font-weight-bold">Preço Total: R$ {{ $total_price }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success">Confirmar Pedido</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#orderModal').on('show.bs.modal', function(e) {
        $(this).addClass('show');
    })
</script>
