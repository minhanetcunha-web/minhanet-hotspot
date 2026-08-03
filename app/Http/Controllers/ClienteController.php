<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteStoreRequest;
use App\Models\Cliente;
use App\Services\ClienteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClienteController extends Controller
{
    protected ClienteService $clienteService;

    public function __construct(ClienteService $clienteService)
    {
        $this->clienteService = $clienteService;
    }

    public function index(): View
    {
        $clientes = Cliente::latest()->get();

        return view('clientes.index', compact('clientes'));
    }

    public function create(): View
    {
        return view('clientes.create');
    }

    public function store(ClienteStoreRequest $request): RedirectResponse
    {
        $this->clienteService->criarCliente($request->validated());

        return redirect()
            ->route('clientes')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show(Cliente $cliente): View
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente): View
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(ClienteStoreRequest $request, Cliente $cliente): RedirectResponse
    {
        $this->clienteService->atualizarCliente($cliente, $request->validated());

        return redirect()->route('clientes')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(Cliente $cliente): RedirectResponse
    {
        $cliente->delete();

        return redirect()->route('clientes')->with('success', 'Cliente excluído com sucesso!');
    }

    public function bloquear(Cliente $cliente): RedirectResponse
    {
        $cliente->status = $cliente->status === 'Bloqueado' ? 'Ativo' : 'Bloqueado';
        $cliente->save();

        return redirect()->route('clientes')->with('success', 'Status do cliente atualizado com sucesso!');
    }
}
