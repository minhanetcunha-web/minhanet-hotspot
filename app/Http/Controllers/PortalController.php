?php

namespace App\Http\Controllers;

use App\Services\PortalService;
use Illuminate\Http\Request;

class PortalController extends Controller
{
    protected PortalService $portalService;

    public function __construct(PortalService $portalService)
    {
        $this->portalService = $portalService;
    }

    public function pagar(Request $request)
    {
        $pagamento = $this->portalService->criarPagamento(
            (string) $request->plano,
            (float) $request->valor
        );

        return view('wifi.pagamento', [
            'plano' => $request->plano,
            'valor' => $request->valor,
            'pagamento' => $pagamento,
        ]);
    }

    public function webhook(Request $request)
    {
        return response()->json(
            $this->portalService->processarWebhook($request->all())
        );
    }
}
