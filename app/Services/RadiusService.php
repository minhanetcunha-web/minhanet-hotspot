<?php

namespace App\Services;

use App\Models\Cliente;
use App\Models\Hotspot;
use App\Models\RadiusUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;

class RadiusService
{
    public function listarUsuarios(): Collection
    {
        $this->sincronizarClientes();

        return RadiusUser::latest('created_at')->get();
    }

    public function sincronizarClientes(): void
    {
        $clientes = Cliente::whereDoesntHave('radiusUsers')->get();

        if ($clientes->isEmpty()) {
            return;
        }

        $mikrotik = Hotspot::first()?->nome ?? 'MikroTik padrão';

        foreach ($clientes as $cliente) {
            RadiusUser::create([
                'cliente_id' => $cliente->id,
                'usuario' => $this->gerarUsuario($cliente),
                'plano' => $cliente->plano ?? 'Sem plano',
                'mikrotik' => $mikrotik,
                'status' => 'Ativo',
                'tempo_restante' => '30 dias',
                'ip_address' => null,
                'mac_address' => null,
            ]);
        }
    }

    public function sincronizarCliente(Cliente $cliente): RadiusUser
    {
        $usuario = RadiusUser::firstOrNew(['cliente_id' => $cliente->id]);
        $usuario->fill([
            'usuario' => $usuario->usuario ?? $this->gerarUsuario($cliente),
            'plano' => $cliente->plano ?? $usuario->plano ?? 'Sem plano',
            'mikrotik' => $usuario->mikrotik ?? (Hotspot::first()?->nome ?? 'MikroTik padrão'),
            'status' => $usuario->status ?? 'Ativo',
            'tempo_restante' => $usuario->tempo_restante ?? '30 dias',
            'ip_address' => $usuario->ip_address,
            'mac_address' => $usuario->mac_address,
        ])->save();

        return $usuario;
    }

    public function desconectar(RadiusUser $radiusUser): RadiusUser
    {
        $radiusUser->status = 'Desconectado';
        $radiusUser->save();

        return $radiusUser;
    }

    public function bloquear(RadiusUser $radiusUser): RadiusUser
    {
        $radiusUser->status = 'Bloqueado';
        $radiusUser->save();

        return $radiusUser;
    }

    public function reativar(RadiusUser $radiusUser): RadiusUser
    {
        $radiusUser->status = 'Ativo';
        $radiusUser->save();

        return $radiusUser;
    }

    public function excluir(RadiusUser $radiusUser): bool
    {
        return (bool) $radiusUser->delete();
    }

    protected function gerarUsuario(Cliente $cliente): string
    {
        $base = Str::slug($cliente->nome ?: 'cliente', '-');

        return $base . '-' . Str::lower(Str::random(4));
    }
}
