<?php

namespace App\Http\Controllers;

use App\Models\Plano;
use Illuminate\Http\Request;

class PlanoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planos = Plano::all();

        return view('planos.index', compact('planos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('planos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'tempo' => 'required|integer|min:1',
            'unidade_tempo' => 'required',
            'preco' => 'required|numeric',
            'download' => 'required|integer|min:1',
            'upload' => 'required|integer|min:1',
            'simultaneos' => 'required|integer|min:1',
        ]);

        Plano::create([
            'nome' => $request->nome,
            'descricao' => $request->descricao,
            'tempo' => $request->tempo,
            'unidade_tempo' => $request->unidade_tempo,
            'preco' => $request->preco,
            'download' => $request->download,
            'upload' => $request->upload,
            'simultaneos' => $request->simultaneos,
            'status' => 'Ativo',
            'ativo' => true,
        ]);

        return redirect()->route('planos.index')
            ->with('success', 'Plano cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Plano $plano)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plano $plano)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plano $plano)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plano $plano)
    {
        //
    }
}