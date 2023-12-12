<div class="offcanvas offcanvas-end" tabindex="-1" id="orderOffcanvas{{ $orderPreparation->id }}"
    aria-labelledby="orderOffcanvasLabel{{ $orderPreparation->id }}" style="max-width: 880px; width: 75%;">
    <div class="offcanvas-header">
        <h5 id="orderOffcanvasLabel{{ $orderPreparation->id }}">Detalhes do Pedido</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <span class="font-weight-bold">Pedido </span>
                    <p># {{ $orderPreparation->display_id }}</p>
                    <span class="font-weight-bold">Feito em</span>
                    <p>
                        {{ Carbon\Carbon::parse($orderPreparation->order_created_at)->format('d/m/Y') }} as
                        {{ Carbon\Carbon::parse($orderPreparation->order_created_at)->format('H:i') }}
                    </p>
                    <span class="font-weight-bold">Tipo de pedido: </span>
                    <p>{{ $orderPreparation->order_type }}</p>
                </div>

                <div class="col-8">
                    <div class=''>
                        <span class="font-weight-bold">Itens do Pedido</span>
                        <table class="table shadow-sm p-3 mb-5 bg-body rounded">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Unidade</th>
                                    <th scope="col">Quantidade</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderPreparation->orderItems as $item)
                                    <tr>
                                        <td class="fs-6">{{ $item->name }}</td>
                                        <td>{{ $item->unit }}</td>
                                        <td>{{ $item->quantity }}x</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas-footer d-flex justify-content-end mb-5">
        <button type="button" class="btn btn-success ms-auto my-custom-button">Start Preparation</button>
    </div>
</div>
