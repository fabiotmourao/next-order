<?php

namespace Tests\Feature;

use App\Services\IfoodService;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use Illuminate\Support\Facades\Config;

// sail artisan test tests/Feature/IfoodServiceTest.php
class IfoodServiceTest extends TestCase
{
    // sail artisan test --filter test_getAccessToken_returns_access_token
    public function test_getAccessToken_returns_access_token()
    {
        $this->refreshApplication();

        $ifoodService = new IfoodService();

        // Pega as credenciais do Ifood do arquivo config/services.php
        $this->clientId = Config::get('services.ifood.client_id');
        $this->clientSecret = Config::get('services.ifood.client_secret');

        // Faz a requisição à API do Ifood
        $accessToken = $ifoodService->getAccessToken();

        // Verifica se o token de acesso é válido
        $this->assertNotEmpty($accessToken);
    }

    // sail artisan test --filter test_getEvents_returns_valid_data_separately
    public function test_getEvents_returns_valid_data_separately()
    {
        $this->refreshApplication();

        $ifoodService = new IfoodService();

        $events = $ifoodService->getOrderEvents();

        // Verifica se a resposta é um array
        $this->assertIsArray($events);

        // Se o código de status for 204, deve estar vazio
        if (empty($events)) {
            $this->assertEquals(204, $ifoodService->getLastResponseStatus());
        } else {
            // Verifica se o array de eventos contém pelo menos um evento
            $this->assertGreaterThan(0, count($events));
        }
    }

    // sail artisan test --filter test_getEvents_returns_empty_array_when_no_data
    // public function test_getEvents_returns_empty_array_when_no_data()
    // {
    //     // Inicializa o Laravel
    //     $this->refreshApplication();

    //     // Cria uma instância do serviço IfoodService
    //     $ifoodService = new IfoodService();

    //     // Sobrescreve o método getOrderEvents para retornar um array vazio
    //     $this->app->bind(IfoodService::class, function ($app) use ($ifoodService) {
    //         return $ifoodService;
    //     });

    //     // Faz a chamada para a função a ser testada
    //     $events = $ifoodService->getOrderEvents();

    //     // Verifica se a resposta é um array vazio
    //     $this->assertIsArray($events);
    //     $this->assertCount(0, $events);
    // }

    // sail artisan test --filter test_getOrderDetails_returns_order_details
    public function test_getOrderDetails_returns_order_details()
    {
        $this->refreshApplication();

        $ifoodService = new IfoodService();

        // Obtém uma lista de orderId
        $events = $ifoodService->getOrderEvents();

        // Itera sobre cada orderId e verifica os detalhes
        foreach ($events as $event) {
            // Verifica se o evento possui o campo orderId
            if (isset($event['orderId'])) {
                // Obtém o orderId do evento
                $orderId = $event['orderId'];

                // Faz a requisição à API do Ifood para obter os detalhes do pedido
                $orderDetails = $ifoodService->getOrderDetails($orderId);

                // Verifica se os detalhes do pedido são válidos
                $this->assertNotEmpty($orderDetails);
            }
        }
    }

    // sail artisan test --filter test_acknowledgeOrderEvent_success
    public function test_acknowledgeOrderEvent_success()
    {
        // Inicializa o Laravel
        $this->refreshApplication();

        // Cria uma instância do serviço IfoodService
        $ifoodService = new IfoodService();

        try {
            // Tenta reconhecer o evento
            $response = $ifoodService->acknowledgeOrderEvent();

            // Verifica se a resposta não é nula
            $this->assertNotNull($response);

            // Verifica se a resposta foi bem-sucedida (status code 200)
            $this->assertEquals(202, $response->getStatusCode());

            // Você pode adicionar mais asserções conforme necessário para garantir que a resposta seja como esperado

        } catch (\Exception $e) {
            // Trata qualquer exceção lançada pelo método
            $this->fail('Erro ao executar test_acknowledgeOrderEvent_success: ' . $e->getMessage());
        }
    }
}
