<?php

namespace App\Services;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;

class MercadoPagoService
{
    public function __construct()
    {
        // Prefer ENV, then config/services.php
        $token = env('MERCADOPAGO_ACCESS_TOKEN') ?: config('services.mercadopago.token');

        if (!is_string($token) || trim($token) === '') {
            // Throw a clearer exception so developers know how to fix it
            throw new \RuntimeException("MERCADOPAGO_ACCESS_TOKEN is not configured. Please set MERCADOPAGO_ACCESS_TOKEN in your .env or define services.mercadopago.token in config/services.php.");
        }

        MercadoPagoConfig::setAccessToken($token);
    }

    /**
     * Criar pagamento PIX no Mercado Pago
     *
     * @param string $descricao
     * @param float|string $valor
     * @param string|null $payerEmail
     * @return mixed
     */
    public function criarPix($descricao, $valor, ?string $payerEmail = null)
    {
        $client = new PaymentClient();

        $payload = [
            "transaction_amount" => (float) $valor,
            "description" => $descricao,
            "payment_method_id" => "pix",
            "payer" => [
                "email" => $payerEmail ?? 'cliente@minhanet.com.br'
            ],
            // Allow notification URL to be configured via .env
            "notification_url" => env('MERCADOPAGO_NOTIFICATION_URL', config('services.mercadopago.notification_url'))
        ];

        return $client->create($payload);
    }
}
