<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanoStoreRequest;
use App\Models\Plano;
use App\Services\PlanoService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PlanoController extends Controller
{
    protected PlanoService $planoService;

    public function __construct(PlanoService $planoService)
    {
        $this->planoService = $planoService;
    }

    public function index(): View
    {
        $planos = Plano::all();

        return view('planos.index', compact('planos'));
    }

    public function create(): View
    {
        return view('planos.create');
    }

    public function store(PlanoStoreRequest $request)
    {
        $this->planoService->criarPlano($request->validated());

        return redirect()
            ->route('planos')
            ->with('success', 'Plano cadastrado com sucesso!');
    }

    public function show(Plano $plano)
    {
        //
    }

    public function edit(Plano $plano)
    {
        //
    }

    public function update(Request $request, Plano $plano)
    {
        //
    }

    public function destroy(Plano $plano)
    {
        //
    }
}