<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteStoreRequest;
use App\Services\ClienteService;
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
        return view('clientes.index');
    }

    public function create(): View
    {
        return view('clientes.create');
    }

    public function store(ClienteStoreRequest $request)
    {
        $this->clienteService->criarCliente($request->validated());

        return redirect()
            ->route('clientes')
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
