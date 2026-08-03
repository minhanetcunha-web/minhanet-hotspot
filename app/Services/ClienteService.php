<?php

namespace App\Services;

use App\Models\Cliente;

class ClienteService
{
    public function criarCliente(array $data): Cliente
    {
        $cliente = Cliente::create([
            'nome' => $data['nome'],
            'email' => $data['email'] ?? null,
            'telefone' => $data['telefone'] ?? null,
            'plano' => $data['plano'] ?? null,
            'status' => $data['status'] ?? 'Ativo',
        ]);

        app(RadiusService::class)->sincronizarCliente($cliente);

        return $cliente;
    }

    public function criarClientePortal(array $data): Cliente
    {
        $cliente = Cliente::firstOrCreate(
            ['email' => $data['email']],
            [
                'nome' => $data['nome'],
                'email' => $data['email'],
                'telefone' => $data['telefone'] ?? null,
                'plano' => $data['plano'] ?? null,
                'status' => 'Ativo',
            ]
        );

        app(RadiusService::class)->sincronizarCliente($cliente);

        return $cliente;
    }

    public function atualizarCliente(Cliente $cliente, array $data): Cliente
    {
        $cliente->fill([
            'nome' => $data['nome'] ?? $cliente->nome,
            'email' => $data['email'] ?? $cliente->email,
            'telefone' => $data['telefone'] ?? $cliente->telefone,
            'plano' => $data['plano'] ?? $cliente->plano,
            'status' => $data['status'] ?? $cliente->status,
        ])->save();

        app(RadiusService::class)->sincronizarCliente($cliente);

        return $cliente;
    }
}
