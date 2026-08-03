<?php

namespace App\Http\Controllers;

use App\Services\PortalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PortalController extends Controller
{
    protected PortalService $portalService;

    public function __construct(PortalService $portalService)
    {
        $this->portalService = $portalService;
    }

    // Exibe formulário de pré-cadastro (nome, email, contato)
    public function showCadastro()
    {
        return view('portal.cadastro');
    }

    // Recebe pré-cadastro, valida e salva em sessão, redireciona para seleção de planos
    public function storeCadastro(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'contato' => 'nullable|string|max:50',
        ]);

        Session::put('portal_customer', $data);

        return redirect()->route('portal.planos');
    }

    // Mostra a lista de planos (somente após pré-cadastro idealmente)
    public function showPlanos(Request $request)
    {
        $customer = Session::get('portal_customer');

        // opcional: se não houver cliente, redireciona ao cadastro
        if (! $customer) {
            return redirect()->route('portal.cadastro')->with('warning', 'Por favor, preencha seus dados antes de escolher um plano.');
        }

        return view('portal.index', ['customer' => $customer]);
    }

    // Criar pagamento e exibir QR/Pix
    public function pagar(Request $request)
    {
        $customer = Session::get('portal_customer');

        if (! $customer) {
            return redirect()->route('portal.cadastro')->with('warning', 'Informações do cliente não encontradas. Preencha o pré-cadastro.');
        }

        $request->validate([
            'plano' => 'required|string',
            'valor' => 'required',
        ]);

        // criar pagamento via service, passando o email do cliente salvo na sessão para o payer
        $pagamento = $this->portalService->criarPagamento(
            (string) $request->plano,
            (float) $request->valor,
            $customer['email'] ?? null
        );

        // passar variável 'pix' para a view porque o template espera $pix
        return view('portal.pagamento', [
            'plano' => $request->plano,
            'valor' => $request->valor,
            'pix' => $pagamento,
            'customer' => $customer,
        ]);
    }

    public function webhook(Request $request)
    {
        return response()->json(
            $this->portalService->processarWebhook($request->all())
        );
    }
}
