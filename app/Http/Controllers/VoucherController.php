<?php

namespace App\Http\Controllers;

use App\Models\Voucher;
use App\Models\Hotspot;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Services\MikrotikApi;

class VoucherController extends Controller
{
    protected $mikrotik;

    public function __construct(MikrotikApi $mikrotik)
    {
        $this->mikrotik = $mikrotik;
    }

    public function index()
    {
        $vouchers = Voucher::latest()->get();

        return view('vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        return view('vouchers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'perfil' => 'required',
            'valor' => 'required|numeric',
        ]);

        $codigo = strtoupper(Str::random(8));

        Voucher::create([
            'codigo' => $codigo,
            'perfil' => $request->perfil,
            'valor' => $request->valor,
            'status' => 'pendente',
        ]);

        $hotspot = Hotspot::first();

        if (!$hotspot) {
            return redirect()
                ->route('vouchers')
                ->with('error', 'Nenhum MikroTik cadastrado.');
        }

        $this->mikrotik->criarUsuarioHotspot(
            $hotspot->ip,
            $hotspot->porta,
            $hotspot->usuario,
            $hotspot->senha,
            $codigo,
            '123456',
            $request->perfil
        );

        return redirect()
            ->route('vouchers')
            ->with('success', 'Voucher criado com sucesso!');
    }
}