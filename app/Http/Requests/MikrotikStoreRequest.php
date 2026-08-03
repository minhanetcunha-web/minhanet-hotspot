<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MikrotikStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'empresa' => ['nullable', 'string', 'max:255'],
            'ip' => ['required', 'ip'],
            'porta' => ['required', 'integer', 'min:1', 'max:65535'],
            'usuario' => ['required', 'string', 'max:255'],
            'senha' => ['required', 'string', 'max:255'],
            'servidor_radius' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable', 'string', 'max:50'],
            'chave_publica_wireguard' => ['nullable', 'string'],
            'chave_privada_wireguard' => ['nullable', 'string'],
            'ip_vpn' => ['nullable', 'ip'],
            'porta_wireguard' => ['nullable', 'integer', 'min:1', 'max:65535'],
            'endpoint_vpn' => ['nullable', 'string', 'max:255'],
            'allowed_ips' => ['nullable', 'string'],
            'api_ssl' => ['nullable', 'boolean'],
            'nome_hotspot' => ['nullable', 'string', 'max:255'],
            'ativo' => ['nullable', 'boolean'],
        ];
    }
}
