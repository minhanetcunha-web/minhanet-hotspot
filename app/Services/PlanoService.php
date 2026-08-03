<?php

namespace App\Services;

use App\Models\Plano;

class PlanoService
{
    public function criarPlano(array $data): Plano
    {
        return Plano::create([
            'nome' => $data['nome'],
            'descricao' => $data['descricao'] ?? null,
            'tempo' => $data['tempo'],
            'unidade_tempo' => $data['unidade_tempo'],
            'preco' => $data['preco'],
            'download' => $data['download'],
            'upload' => $data['upload'],
            'simultaneos' => $data['simultaneos'],
            'status' => 'Ativo',
            'ativo' => true,
        ]);
    }
}
