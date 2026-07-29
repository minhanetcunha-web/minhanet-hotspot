<?php

namespace App\Services;

use RouterOS\Client;
use RouterOS\Query;

class HotspotService
{
    protected MikrotikApi $mikrotik;

    public function __construct(MikrotikApi $mikrotik)
    {
        $this->mikrotik = $mikrotik;
    }

    /**
     * Conecta ao MikroTik
     */
    public function conectar($host, $porta, $usuario, $senha): Client
    {
        return $this->mikrotik->conectar(
            $host,
            $porta,
            $usuario,
            $senha
        );
    }
}