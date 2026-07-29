<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MercadoPagoService;
use App\Services\MikrotikApi;
use App\Models\Pagamento;

class PortalController extends Controller
{
    public function pagar(Request $request)
    {
        $mercadoPago = new MercadoPagoService();

        $pagamento = $mercadoPago->criarPix(
            $request->plano,
            $request->valor
        );

        return view('wifi.pagamento', [
            'plano' => $request->plano,
            'valor' => $request->valor,
            'pagamento' => $pagamento,
        ]);
    }
    
    public function webhook(Request $request)
{
    \Log::info('Webhook Mercado Pago', $request->all());

    $mikrotik = new MikrotikApi();

    // Aqui vamos criar o voucher automaticamente.
    // Na próxima etapa substituiremos por dados vindos do pagamento.

    return response()->json([
        'status' => 'ok'
    ]);
}
}