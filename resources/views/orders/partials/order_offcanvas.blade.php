<div class="offcanvas offcanvas-end" tabindex="-1" id="orderOffcanvas{{ $order->id }}"
    aria-labelledby="orderOffcanvasLabel{{ $order->id }}" style="max-width: 945px; width: 75%;">
    <div class="offcanvas-header">
        <h5 id="orderOffcanvasLabel{{ $order->id }}">Detalhes do Pedido</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
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
    <div class="offcanvas-footer d-flex justify-content-end mb-5">
        <button type="button" class="btn btn-success ms-auto my-custom-button">Confirmar Pedido</button>
    </div>



</div>
