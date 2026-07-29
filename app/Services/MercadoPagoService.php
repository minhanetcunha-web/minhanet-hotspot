<?php

namespace App\Services;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;

class MercadoPagoService
{
    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));
    }

    public function criarPix($descricao, $valor)
    {
    $client = new PaymentClient();

    return $client->create([
        "transaction_amount" => (float) $valor,
        "description" => $descricao,
        "payment_method_id" => "pix",
        "payer" => [
            "email" => "cliente@minhanet.com.br"
        ],
        "notification_url" => "https://exploration-billion-tables-important.trycloudflare.com/webhook/mercadopago"
    ]);
}
}
