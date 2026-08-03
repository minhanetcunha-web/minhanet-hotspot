<?php

namespace App\Services;

use App\Models\Hotspot;
use App\Models\Voucher;
use Illuminate\Support\Str;

class VoucherService
{
    protected MikrotikApi $mikrotik;

    public function __construct(MikrotikApi $mikrotik)
    {
        $this->mikrotik = $mikrotik;
    }

    public function criarVoucher(string $perfil, float $valor): Voucher
    {
        $codigo = strtoupper(Str::random(8));

        $voucher = Voucher::create([
            'codigo' => $codigo,
            'perfil' => $perfil,
            'valor' => $valor,
            'status' => 'pendente',
        ]);

        $hotspot = Hotspot::first();

        if (! $hotspot) {
            throw new \RuntimeException('Nenhum MikroTik cadastrado.');
        }

        $this->mikrotik->criarUsuarioHotspot(
            $hotspot->ip,
            $hotspot->porta,
            $hotspot->usuario,
            $hotspot->senha,
            $codigo,
            '123456',
            $perfil
        );

        return $voucher;
    }
}
