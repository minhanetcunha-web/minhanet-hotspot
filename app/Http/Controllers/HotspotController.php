<?php

namespace App\Http\Controllers;

use App\Models\Hotspot;
use Illuminate\Http\Request;
use App\Services\MikrotikApi;

class HotspotController extends Controller
{
    public function index()
    {
        return view('hotspots.index', [
            'hotspots' => Hotspot::all()
        ]);
    }

    public function create()
    {
        return view('hotspots.create');
    }

    public function store(Request $request)
    {
        Hotspot::create($request->all());

        return redirect()
            ->route('hotspots')
            ->with('success', 'Hotspot cadastrado com sucesso!');
    }

    public function testarConexao($id)
    {
        $hotspot = Hotspot::findOrFail($id);

        try {
            $api = new MikrotikApi();

            $resultado = $api->testarConexao(
                $hotspot->ip,
                $hotspot->porta,
                $hotspot->usuario,
                $hotspot->senha
            );

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

            $api = new MikrotikApi();

            $perfis = [
                ['1 Hora', '10M/10M', '1h'],
                ['2 Horas', '10M/10M', '2h'],
                ['4 Horas', '20M/20M', '4h'],
                ['5 Horas', '25M/25M', '5h'],
            ];

            foreach ($perfis as $perfil) {

    $api->criarPerfilHotspot(
        $hotspot->ip,
        $hotspot->porta,
        $hotspot->usuario,
        $hotspot->senha,
        $perfil[0],
        $perfil[1],
        $perfil[2]
    );


}

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