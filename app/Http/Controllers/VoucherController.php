<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoucherStoreRequest;
use App\Models\Voucher;
use App\Services\VoucherService;
use Illuminate\View\View;

class VoucherController extends Controller
{
    protected VoucherService $voucherService;

    public function __construct(VoucherService $voucherService)
    {
        $this->voucherService = $voucherService;
    }

    public function index(): View
    {
        $vouchers = Voucher::latest()->get();

        return view('vouchers.index', compact('vouchers'));
    }

    public function create(): View
    {
        return view('vouchers.create');
    }

    public function store(VoucherStoreRequest $request)
    {
        try {
            $this->voucherService->criarVoucher(
                $request->input('perfil'),
                (float) $request->input('valor')
            );

            return redirect()
                ->route('vouchers')
                ->with('success', 'Voucher criado com sucesso!');
        } catch (\RuntimeException $e) {
            return redirect()
                ->route('vouchers')
                ->with('error', $e->getMessage());
        }
    }
}