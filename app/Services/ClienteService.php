<?php

namespace App\Services;

use App\Models\Cliente;

class ClienteService
{
    public function criarCliente(array $data): Cliente
    {
        return Cliente::create([
            'nome' => $data['nome'],
            'telefone' => $data['telefone'] ?? null,
            'plano' => $data['plano'] ?? null,
            'status' => 'Ativo',
        ]);
    }
}
