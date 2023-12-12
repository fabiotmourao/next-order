<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\OrderEvent;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Order;
use App\Models\DeliveryAddress;
use App\Models\OrderItem;
use App\Services\IfoodService;

class OrderEventProcessor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:process-events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'processa eventos do ifood salva/atualiza a cada 30s';

    public function __construct(IfoodService $ifoodService)
    {
        parent::__construct();
        $this->ifoodService = $ifoodService;
    }
    /**
     * Execute the console command.
     */

    public function handle()
    {
        try {
            $orderEvents = $this->ifoodService->getOrderEvents();

            foreach ($orderEvents as $event) {
                $eventObject = (object)$event;

                $metadata = isset($eventObject->metadata) ? json_encode($eventObject->metadata) : null;

                OrderEvent::updateOrCreate(
                    [
                        'order_id' => $eventObject->orderId,
                    ],
                    [
                        'order_id' => $eventObject->orderId,
                        'code' => $eventObject->code,
                        'full_code' => $eventObject->fullCode,
                        'event_created_at' => Carbon::parse($eventObject->createdAt)->format('Y-m-d H:i:s'),
                        'metadata' => $metadata,
                    ]
                );


                $orderData = $this->ifoodService->getOrderDetails($eventObject->orderId);

                $customerData = (object)$orderData['customer'];

                $customer = Customer::updateOrCreate(
                    [
                        'customer_id_external' => $customerData->id,
                    ],
                    [
                        'customer_id_external' => $customerData->id,
                        'name' => $customerData->name,
                        'document_number' => $customerData->documentNumber,
                        'phone' => $customerData->phone,
                        'orders_count_on_merchant' => $customerData->ordersCountOnMerchant,
                        'segmentation' => $customerData->segmentation,
                    ]
                );

                $order = (object) $orderData;

                $orders =  Order::updateOrCreate(
                    ['order_id_external' => $order->id],
                    [
                        'order_id_external' => $order->id,
                        'order_type' => $order->orderType,
                        'order_timing' => $order->orderTiming,
                        'display_id' => $order->displayId,
                        'order_created_at' => Carbon::parse($order->createdAt)->format('Y-m-d H:i:s'),
                        'preparation_start_date_time' => $order->preparationStartDateTime,
                        'is_test' => $order->isTest,
                        'customer_id' => $customer->id,
                    ]
                );

                $deliveryData = json_decode(json_encode($orderData['delivery']), false);

                DeliveryAddress::updateOrCreate(
                    ['order_id' => $orders->id],
                    [
                        'order_id' => $orders->id,
                        'deliveredBy' => $deliveryData->deliveredBy,
                        'deliveryDateTime' => $deliveryData->deliveryDateTime,
                        'mode' => $deliveryData->mode,
                        'observations' => $deliveryData->observations,
                        'street_name' => $deliveryData->deliveryAddress->streetName,
                        'street_number' => $deliveryData->deliveryAddress->streetNumber,
                        'formatted_address' => $deliveryData->deliveryAddress->formattedAddress,
                        'neighborhood' => $deliveryData->deliveryAddress->neighborhood,
                        'complement' => $deliveryData->deliveryAddress->complement,
                        'postal_code' => $deliveryData->deliveryAddress->postalCode,
                        'city' => $deliveryData->deliveryAddress->city,
                        'state' => $deliveryData->deliveryAddress->state,
                        'country' => $deliveryData->deliveryAddress->country,
                        'reference' => $deliveryData->deliveryAddress->reference,
                        'latitude' => $deliveryData->deliveryAddress->coordinates->latitude,
                        'longitude' => $deliveryData->deliveryAddress->coordinates->longitude,
                        'pickupCode' => $deliveryData->pickupCode,
                    ]
                );

                $orderItems = (object) $orderData['items'];

                foreach ($orderItems as $item) {
                    $itemObject = (object) $item;

                    OrderItem::updateOrCreate(
                        ['order_id' => $orders->id, 'item_id_external' => $itemObject->id],
                        [
                            'order_id' => $orders->id,
                            'index' => $itemObject->index,
                            'item_id_external' => $itemObject->id,
                            'uniqueId' => $itemObject->uniqueId,
                            'name' => $itemObject->name,
                            'unit' => $itemObject->unit,
                            'quantity' => $itemObject->quantity,
                            'unit_price' => $itemObject->unitPrice,
                            'options_price' => $itemObject->optionsPrice,
                            'total_price' => $itemObject->totalPrice,
                            'price' => $itemObject->price,
                        ]
                    );
                }
            }
            $this->info('Eventos do pedido processados com sucesso.');
        } catch (\Exception $e) {
            $this->error('Erro ao processar eventos do pedido: ' . $e->getMessage());
        }
    }
}
