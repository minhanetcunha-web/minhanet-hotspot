<?php

use App\Http\Controllers\PortalController;
use Illuminate\Support\Facades\Route;

// Pre-cadastro: cliente informa nome, email e contato
// Rota principal do portal mantém o nome 'portal' para compatibilidade com links existentes
Route::get('/portal', [PortalController::class, 'showCadastro'])->name('portal');
Route::get('/portal/cadastro', [PortalController::class, 'showCadastro'])->name('portal.cadastro');
Route::post('/portal/registrar', [PortalController::class, 'storeCadastro'])->name('portal.registrar');

// Página de escolha de planos — acessível após pré-cadastro
Route::get('/portal/planos', [PortalController::class, 'showPlanos'])->name('portal.planos');

// Pagamento (PIX via Mercado Pago)
Route::post('/portal/pagar', [PortalController::class, 'pagar'])
    ->name('portal.pagar');

// Compatibilidade antiga /wifi
Route::get('/wifi', function () {
    return view('wifi.index');
})->name('wifi');

Route::post('/wifi/pagar', [PortalController::class, 'pagar'])
    ->name('wifi.pagar');
