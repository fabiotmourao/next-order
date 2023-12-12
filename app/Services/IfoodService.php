<?php

namespace App\Services;

use Dflydev\DotAccessData\Data;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class IfoodService
{
    private $clientId;
    private $clientSecret;
    public $http;

    public function __construct()
    {
        $this->clientId = Config::get('services.ifood.client_id');
        $this->clientSecret = Config::get('services.ifood.client_secret');
        $this->http = new Client([
            'base_uri' => 'https://merchant-api.ifood.com.br/',
        ]);
    }

    public function getAccessToken()
    {
        try {
            $response = $this->http->post('authentication/v1.0/oauth/token', [
                'form_params' => [
                    'grantType' => 'client_credentials',
                    'clientId' => $this->clientId,
                    'clientSecret' => $this->clientSecret,
                ],
            ]);

            if ($response->getStatusCode() === 200) {
                $token = json_decode($response->getBody(), true)['accessToken'];
                return $token;
            }
        } catch (\Exception $e) {
            logger('Error in getAccessToken: ' . $e->getMessage());

            throw new \Exception('Erro ao obter AccessToken: ' . $e->getMessage());
        }
    }

    public function getOrderEvents()
    {
        try {
            $accessToken = $this->getAccessToken();

            $response = $this->http->get('order/v1.0/events:polling', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            $body = $response->getBody()->getContents();

            $data = json_decode($body, true);

            return !empty($data) ? $data : [];
        } catch (\Exception $e) {
            logger('Error in getEvents: ' . $e->getMessage());

            throw new \Exception('Erro ao obter eventos: ' . $e->getMessage());
        }
    }

    public function getOrderDetails($orderId)
    {
        try {
            if (empty($orderId)) {
                return [];
            }

            $accessToken = $this->getAccessToken();

            $response = $this->http->get("order/v1.0/orders/{$orderId}", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);

            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);

            return $data;
        } catch (\Exception $e) {
            logger('Error in getOrderDetails: ' . $e->getMessage());

            throw new \Exception('Erro ao obter detalhes do pedido: ' . $e->getMessage());
        }
    }

    public function acknowledgeOrderEvent()
    {
        try {
            $events = $this->getOrderEvents();

            if (empty($events)) {
                throw new \Exception('Não há eventos para reconhecer.');
            }

            $accessToken = $this->getAccessToken();

            $body = json_encode($events);

            $response = $this->http->post("order/v1.0/events/acknowledgment", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
                'body' => $body,
            ]);

            return $response;
        } catch (\Exception $e) {
            logger('Error in acknowledgeOrderEvent: ' . $e->getMessage());

            throw new \Exception('Erro ao enviar acknowledgeOrderEvent: ' . $e->getMessage());
        }
    }

    public function confirmOrder($orderId)
    {
        try {
            $accessToken = $this->getAccessToken();

            $response = $this->http->post("order/{$orderId}/confirm", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);
            return $response;

        } catch (\Exception $e) {
            logger('Error in confirmOrder: ' . $e->getMessage());
            return null;
        }
    }
}
