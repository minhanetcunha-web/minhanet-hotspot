<?php

namespace App\Services;

use App\Models\Hotspot;
use RouterOS\Client;

class HotspotService
{
    protected MikrotikApi $mikrotik;

    public function __construct(MikrotikApi $mikrotik)
    {
        $this->mikrotik = $mikrotik;
    }

    public function conectar($host, $porta, $usuario, $senha): Client
    {
        return $this->mikrotik->conectar(
            $host,
            $porta,
            $usuario,
            $senha
        );
    }

    public function criarHotspot(array $data): Hotspot
    {
        return Hotspot::create([
            'nome' => $data['nome'],
            'ip' => $data['ip'],
            'porta' => $data['porta'],
            'usuario' => $data['usuario'],
            'senha' => $data['senha'],
            'nome_hotspot' => $data['nome_hotspot'] ?? null,
            'ativo' => $data['ativo'] ?? true,
        ]);
    }

    public function testarConexao(Hotspot $hotspot): array
    {
        return $this->mikrotik->testarConexao(
            $hotspot->ip,
            $hotspot->porta,
            $hotspot->usuario,
            $hotspot->senha
        );
    }

    public function criarPerfis(Hotspot $hotspot): array
    {
        $perfis = [
            ['1 Hora', '10M/10M', '1h'],
            ['2 Horas', '10M/10M', '2h'],
            ['4 Horas', '20M/20M', '4h'],
            ['5 Horas', '25M/25M', '5h'],
        ];

        foreach ($perfis as $perfil) {
            $this->mikrotik->criarPerfilHotspot(
                $hotspot->ip,
                $hotspot->porta,
                $hotspot->usuario,
                $hotspot->senha,
                $perfil[0],
                $perfil[1],
                $perfil[2]
            );
        }

        return $perfis;
    }
}