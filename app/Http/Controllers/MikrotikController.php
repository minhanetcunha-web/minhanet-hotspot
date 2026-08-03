<?php

namespace App\Http\Controllers;

use App\Http\Requests\MikrotikStoreRequest;
use App\Models\Hotspot;
use App\Services\MikrotikService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MikrotikController extends Controller
{
    public function __construct(protected MikrotikService $mikrotikService)
    {
    }

    public function index(): View
    {
        $mikrotiks = Hotspot::latest()->get();

        return view('mikrotiks.index', compact('mikrotiks'));
    }

    public function create(): View
    {
        return view('mikrotiks.create');
    }

    public function store(MikrotikStoreRequest $request): RedirectResponse
    {
        $this->mikrotikService->criarMikrotik($request->validated());

        return redirect()->route('mikrotiks.index')->with('success', 'MikroTik cadastrada com sucesso.');
    }

    public function edit(Hotspot $mikrotik): View
    {
        return view('mikrotiks.edit', compact('mikrotik'));
    }

    public function update(MikrotikStoreRequest $request, Hotspot $mikrotik): RedirectResponse
    {
        $this->mikrotikService->atualizarMikrotik($mikrotik, $request->validated());

        return redirect()->route('mikrotiks.index')->with('success', 'MikroTik atualizada com sucesso.');
    }

    public function destroy(Hotspot $mikrotik): RedirectResponse
    {
        $mikrotik->delete();

        return redirect()->route('mikrotiks.index')->with('success', 'MikroTik removida com sucesso.');
    }

    public function testConnection(Hotspot $mikrotik): RedirectResponse
    {
        try {
            $this->mikrotikService->testarConexao($mikrotik);

            return redirect()->route('mikrotiks.index')->with('success', 'Conexão com a MikroTik realizada com sucesso.');
        } catch (\Throwable $e) {
            return redirect()->route('mikrotiks.index')->with('error', 'Erro ao testar a conexão: ' . $e->getMessage());
        }
    }

    public function sync(Hotspot $mikrotik): RedirectResponse
    {
        $mikrotik->last_sync_at = now();
        $mikrotik->status = 'Sincronizada';
        $mikrotik->save();

        return redirect()->route('mikrotiks.index')->with('success', 'Sincronização iniciada com sucesso.');
    }

    public function script(Hotspot $mikrotik): View
    {
        $script = $this->mikrotikService->gerarScript($mikrotik);

        return view('mikrotiks.script', compact('mikrotik', 'script'));
    }
}
