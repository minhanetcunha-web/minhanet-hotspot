<?php

namespace App\Services;

use App\Models\Hotspot;
use Illuminate\Support\Str;
use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class MikrotikService
{
    public function criarMikrotik(array $data): Hotspot
    {
        return Hotspot::create([
            'nome' => $data['nome'],
            'empresa' => $data['empresa'] ?? null,
            'ip' => $data['ip'],
            'porta' => (int) ($data['porta'] ?? 8728),
            'usuario' => $data['usuario'],
            'senha' => $data['senha'],
            'nome_hotspot' => $data['nome_hotspot'] ?? null,
            'ativo' => (bool) ($data['ativo'] ?? true),
            'status' => $data['status'] ?? 'Ativo',
            'servidor_radius' => $data['servidor_radius'] ?? null,
            'chave_publica_wireguard' => $data['chave_publica_wireguard'] ?? null,
            'chave_privada_wireguard' => $data['chave_privada_wireguard'] ?? null,
            'ip_vpn' => $data['ip_vpn'] ?? null,
            'porta_wireguard' => $data['porta_wireguard'] ?? null,
            'endpoint_vpn' => $data['endpoint_vpn'] ?? null,
            'allowed_ips' => $data['allowed_ips'] ?? null,
            'api_ssl' => (bool) ($data['api_ssl'] ?? false),
        ]);
    }

    public function atualizarMikrotik(Hotspot $mikrotik, array $data): Hotspot
    {
        $mikrotik->fill([
            'nome' => $data['nome'] ?? $mikrotik->nome,
            'empresa' => $data['empresa'] ?? $mikrotik->empresa,
            'ip' => $data['ip'] ?? $mikrotik->ip,
            'porta' => (int) ($data['porta'] ?? $mikrotik->porta),
            'usuario' => $data['usuario'] ?? $mikrotik->usuario,
            'senha' => $data['senha'] ?? $mikrotik->senha,
            'nome_hotspot' => $data['nome_hotspot'] ?? $mikrotik->nome_hotspot,
            'ativo' => (bool) ($data['ativo'] ?? $mikrotik->ativo),
            'status' => $data['status'] ?? $mikrotik->status,
            'servidor_radius' => $data['servidor_radius'] ?? $mikrotik->servidor_radius,
            'chave_publica_wireguard' => $data['chave_publica_wireguard'] ?? $mikrotik->chave_publica_wireguard,
            'chave_privada_wireguard' => $data['chave_privada_wireguard'] ?? $mikrotik->chave_privada_wireguard,
            'ip_vpn' => $data['ip_vpn'] ?? $mikrotik->ip_vpn,
            'porta_wireguard' => $data['porta_wireguard'] ?? $mikrotik->porta_wireguard,
            'endpoint_vpn' => $data['endpoint_vpn'] ?? $mikrotik->endpoint_vpn,
            'allowed_ips' => $data['allowed_ips'] ?? $mikrotik->allowed_ips,
            'api_ssl' => (bool) ($data['api_ssl'] ?? $mikrotik->api_ssl),
        ])->save();

        return $mikrotik;
    }

    public function gerarScript(Hotspot $mikrotik): string
    {
        $nomeInterface = Str::slug($mikrotik->nome ?: 'mikrotik', '-');
        $allowedIps = $mikrotik->allowed_ips ?: '0.0.0.0/0';
        $publicKey = $mikrotik->chave_publica_wireguard ?: 'PUBKEY';
        $privateKey = $mikrotik->chave_privada_wireguard ?: 'PRIVKEY';
        $vpnAddress = $mikrotik->ip_vpn ?: '10.200.0.2/24';
        $vpnPort = $mikrotik->porta_wireguard ?: 13231;
        $vpnEndpoint = $mikrotik->endpoint_vpn ?: 'vpn.exemplo.com:51820';
        $radiusServer = $mikrotik->servidor_radius ?: '10.0.0.10';
        $apiPort = (int) $mikrotik->porta;
        $apiSsl = (bool) $mikrotik->api_ssl;

        $apiSslBlock = $apiSsl
            ? "/ip/service set api-ssl disabled=no
"
            : "# API-SSL desativado. Habilite o campo API SSL caso queira usar HTTPS na API.
";

        return <<<SCRIPT
# Script RouterOS 7 para integração com o painel MinhaNet
# MikroTik: {$mikrotik->nome}
# Empresa: {$mikrotik->empresa}

/interface/wireguard
add name="wg-{$nomeInterface}" listen-port={$vpnPort} private-key="{$privateKey}"

/interface/wireguard/peers
add interface=wg-{$nomeInterface} public-key="{$publicKey}" allowed-address="{$allowedIps}" endpoint="{$vpnEndpoint}" persistent-keepalive=25s

/ip/address
add address="{$vpnAddress}" interface=wg-{$nomeInterface}

/ip/route
add dst-address=0.0.0.0/0 gateway={$vpnAddress}

/ip/dns
set servers=1.1.1.1,8.8.8.8

/ip/service
set api address=0.0.0.0/0 disabled=no port={$apiPort}
{$apiSslBlock}

/radius
add address={$radiusServer} service=ppp,login,hotspot auth-port=1812 acct-port=1813 secret="{$mikrotik->senha}"

/ip/hotspot
set enabled=yes interface=bridge1

/ip/hotspot/profile
add name="default" hotspot-address="{$mikrotik->ip}" rate-limit="10M/10M" shared-users=unlimited

/ip/hotspot/walled-garden/ip
add action=accept disabled=no dst-host="*.google.com"

/ip/firewall/nat
add chain=srcnat out-interface=wg-{$nomeInterface} action=masquerade
add chain=dstnat protocol=tcp dst-port=80 action=dst-nat to-addresses={$mikrotik->ip} to-ports=80

/ip/firewall/filter
add chain=forward action=accept in-interface=wg-{$nomeInterface} comment="Acesso via WireGuard"
add chain=input action=accept protocol=tcp dst-port={$apiPort} comment="API MikroTik"

/system identity
set name="{$mikrotik->nome}"

# Comunicação com o VPS / servidor central
# Ajuste o endpoint do servidor VPN e a rota conforme a sua topologia.
SCRIPT;
    }

    public function testarConexao(Hotspot $mikrotik): array
    {
        $config = new Config([
            'host' => $mikrotik->ip,
            'user' => $mikrotik->usuario,
            'pass' => $mikrotik->senha,
            'port' => (int) $mikrotik->porta,
            'timeout' => 5,
        ]);

        $client = new Client($config);
        $query = new Query('/system/identity/print');
        $response = $client->query($query)->read();

        return ['status' => 'ok', 'response' => $response];
    }
}
