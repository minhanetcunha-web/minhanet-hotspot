<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    protected $fillable = [
        'nome',
        'empresa',
        'ip',
        'porta',
        'usuario',
        'senha',
        'nome_hotspot',
        'ativo',
        'status',
        'servidor_radius',
        'chave_publica_wireguard',
        'chave_privada_wireguard',
        'ip_vpn',
        'porta_wireguard',
        'endpoint_vpn',
        'allowed_ips',
        'api_ssl',
        'last_sync_at',
    ];

    protected $casts = [
        'ativo' => 'boolean',
        'api_ssl' => 'boolean',
        'last_sync_at' => 'datetime',
    ];
}
