<?php

namespace App\Http\Controllers;

use App\Http\Requests\HotspotStoreRequest;
use App\Models\Hotspot;
use App\Services\HotspotService;
use Illuminate\View\View;

class HotspotController extends Controller
{
    protected HotspotService $hotspotService;

    public function __construct(HotspotService $hotspotService)
    {
        $this->hotspotService = $hotspotService;
    }

    public function index(): View
    {
        return view('hotspots.index', [
            'hotspots' => Hotspot::all(),
        ]);
    }

    public function create(): View
    {
        return view('hotspots.create');
    }

    public function store(HotspotStoreRequest $request)
    {
        $this->hotspotService->criarHotspot($request->validated());

        return redirect()
            ->route('hotspots')
            ->with('success', 'Hotspot cadastrado com sucesso!');
    }

    public function testarConexao($id)
    {
        $hotspot = Hotspot::findOrFail($id);

        try {
            $resultado = $this->hotspotService->testarConexao($hotspot);

            return response()->json([
                'status' => 'ok',
                'mensagem' => 'Conexão realizada com sucesso!',
                'resultado' => $resultado,
            ]);
        } catch (\Exception $e) {
            return redirect()
                ->route('hotspots')
                ->with('error', 'Erro ao conectar: ' . $e->getMessage());
        }
    }

    public function criarPerfis($id)
    {
        $hotspot = Hotspot::findOrFail($id);

        try {
            $this->hotspotService->criarPerfis($hotspot);

            return redirect()
                ->route('hotspots')
                ->with('success', 'Todos os perfis foram criados com sucesso no MikroTik!');
        } catch (\Exception $e) {
            return redirect()
                ->route('hotspots')
                ->with('error', 'Erro ao criar perfis: ' . $e->getMessage());
        }
    }
}
