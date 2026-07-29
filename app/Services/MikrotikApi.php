<?php

namespace App\Services;

use RouterOS\Client;
use RouterOS\Config;
use RouterOS\Query;

class MikrotikApi
{
    protected $client;

    public function conectar($host, $porta, $usuario, $senha)
    {
        $config = new Config([
            'host'    => $host,
            'user'    => $usuario,
            'pass'    => $senha,
            'port'    => (int) $porta,
            'timeout' => 5,
        ]);

        $this->client = new Client($config);

        return $this->client;
    }

    public function testarConexao($host, $porta, $usuario, $senha)
    {
        $client = $this->conectar($host, $porta, $usuario, $senha);

        $query = new Query('/ip/address/print');

        return $client->query($query)->read();
    }

    public function criarPerfilHotspot($host, $porta, $usuario, $senha, $nome, $rateLimit, $sessionTimeout)
    {
        $this->conectar($host, $porta, $usuario, $senha);

        $query = (new Query('/ip/hotspot/user/profile/add'))
            ->equal('name', $nome)
            ->equal('rate-limit', $rateLimit)
            ->equal('session-timeout', $sessionTimeout);

        return $this->client->query($query)->read();
    }
public function criarUsuarioHotspot($host, $porta, $usuarioApi, $senhaApi, $usuario, $senha, $perfil)
{
    $this->conectar($host, $porta, $usuarioApi, $senhaApi);

    $query = (new Query('/ip/hotspot/user/add'))
        ->equal('name', $usuario)
        ->equal('password', $senha)
        ->equal('profile', $perfil);

    return $this->client->query($query)->read();
}
}