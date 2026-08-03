<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MikrotikController;
use App\Http\Controllers\RadiusController;
use App\Http\Controllers\PortalAdminController;
use App\Http\Controllers\PagamentoController;
use App\Http\Controllers\ConfiguracaoController;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/clientes', [ClienteController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('clientes');

Route::get('/clientes/novo', [ClienteController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('clientes.novo');

Route::post('/clientes', [ClienteController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('clientes.store');

Route::get('/clientes/{cliente}', [ClienteController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('clientes.show');

Route::get('/clientes/{cliente}/editar', [ClienteController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('clientes.edit');

Route::put('/clientes/{cliente}', [ClienteController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('clientes.update');

Route::delete('/clientes/{cliente}', [ClienteController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('clientes.destroy');

Route::post('/clientes/{cliente}/bloquear', [ClienteController::class, 'bloquear'])
    ->middleware(['auth', 'verified'])
    ->name('clientes.bloquear');

Route::patch('/clientes/{cliente}/toggle-status', [ClienteController::class, 'bloquear'])
    ->middleware(['auth', 'verified'])
    ->name('clientes.toggle-status');

Route::get('/planos', [PlanoController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('planos');

Route::get('/planos/novo', [PlanoController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('planos.novo');

Route::post('/planos', [PlanoController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('planos.store');

Route::get('/mikrotiks', [MikrotikController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('mikrotiks.index');

Route::get('/mikrotiks/create', [MikrotikController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('mikrotiks.create');

Route::post('/mikrotiks', [MikrotikController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('mikrotiks.store');

Route::get('/mikrotiks/{mikrotik}/edit', [MikrotikController::class, 'edit'])
    ->middleware(['auth', 'verified'])
    ->name('mikrotiks.edit');

Route::put('/mikrotiks/{mikrotik}', [MikrotikController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('mikrotiks.update');

Route::delete('/mikrotiks/{mikrotik}', [MikrotikController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('mikrotiks.destroy');

Route::post('/mikrotiks/{mikrotik}/test-connection', [MikrotikController::class, 'testConnection'])
    ->middleware(['auth', 'verified'])
    ->name('mikrotiks.test-connection');

Route::post('/mikrotiks/{mikrotik}/sync', [MikrotikController::class, 'sync'])
    ->middleware(['auth', 'verified'])
    ->name('mikrotiks.sync');

Route::get('/mikrotiks/{mikrotik}/script', [MikrotikController::class, 'script'])
    ->middleware(['auth', 'verified'])
    ->name('mikrotiks.script');

Route::get('/hotspots', function () {
    return redirect()->route('mikrotiks.index');
})->middleware(['auth', 'verified'])->name('hotspots');

Route::get('/hotspots/novo', function () {
    return redirect()->route('mikrotiks.create');
})->middleware(['auth', 'verified'])->name('hotspots.novo');

Route::post('/hotspots', function () {
    return redirect()->route('mikrotiks.index');
})->middleware(['auth', 'verified'])->name('hotspots.store');

Route::get('/vouchers', [VoucherController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('vouchers');

Route::get('/vouchers/novo', [VoucherController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('vouchers.novo');

Route::post('/vouchers', [VoucherController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('vouchers.store');

Route::get('/radius', [RadiusController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('radius.index');

Route::patch('/radius/{radiusUser}/disconnect', [RadiusController::class, 'disconnect'])
    ->middleware(['auth', 'verified'])
    ->name('radius.disconnect');

Route::patch('/radius/{radiusUser}/block', [RadiusController::class, 'block'])
    ->middleware(['auth', 'verified'])
    ->name('radius.block');

Route::patch('/radius/{radiusUser}/reactivate', [RadiusController::class, 'reactivate'])
    ->middleware(['auth', 'verified'])
    ->name('radius.reactivate');

Route::delete('/radius/{radiusUser}', [RadiusController::class, 'destroy'])
    ->middleware(['auth', 'verified'])
    ->name('radius.destroy');

// Portais (admin) - redireciona para o portal público por enquanto
Route::get('/portais', function () {
    return redirect()->route('portal');
})->middleware(['auth', 'verified'])->name('portais');

// Pagamentos - redireciona para a tela de vouchers (placeholder)
Route::get('/pagamentos', function () {
    return redirect()->route('vouchers');
})->middleware(['auth', 'verified'])->name('pagamentos');

// Configurações - mostra dashboard como placeholder
Route::get('/configuracoes', function () {
    return redirect()->route('dashboard');
})->middleware(['auth', 'verified'])->name('configuracoes');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
