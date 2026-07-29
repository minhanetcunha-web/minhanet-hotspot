<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class PortalService
{
    protected MercadoPagoService $mercadoPagoService;

    public function __construct(MercadoPagoService $mercadoPagoService)
    {
        $this->mercadoPagoService = $mercadoPagoService;
    }

    public function criarPagamento(string $plano, float|string $valor): mixed
    {
        return $this->mercadoPagoService->criarPix($plano, $valor);
    }

    public function processarWebhook(array $payload): array
    {
        Log::info('Webhook Mercado Pago', $payload);

        return ['status' => 'ok'];
    }
}
