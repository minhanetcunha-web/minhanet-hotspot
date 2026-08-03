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

    /**
     * Cria um pagamento usando o serviço MercadoPagoService.
     * Aceita email do pagador opcional para preencher o payer.email.
     */
    public function criarPagamento(string $plano, float|string $valor, ?string $email = null): mixed
    {
        return $this->mercadoPagoService->criarPix($plano, $valor, $email);
    }

    public function processarWebhook(array $payload): array
    {
        Log::info('Webhook Mercado Pago', $payload);

        return ['status' => 'ok'];
    }
}
