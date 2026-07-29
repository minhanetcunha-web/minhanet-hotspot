?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HotspotController;
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

Route::get('/planos', [PlanoController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('planos');

Route::get('/planos/novo', [PlanoController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('planos.novo');

Route::post('/planos', [PlanoController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('planos.store');

Route::get('/hotspots', [HotspotController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('hotspots');

Route::get('/hotspots/novo', [HotspotController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('hotspots.novo');

Route::post('/hotspots', [HotspotController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('hotspots.store');

Route::get('/hotspots/{id}/testar', [HotspotController::class, 'testarConexao'])
    ->middleware(['auth', 'verified'])
    ->name('hotspots.testar');

Route::get('/hotspots/{id}/criar-perfis', [HotspotController::class, 'criarPerfis'])
    ->middleware(['auth', 'verified'])
    ->name('hotspots.criarPerfis');

Route::get('/vouchers', [VoucherController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('vouchers');

Route::get('/vouchers/novo', [VoucherController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('vouchers.novo');

Route::post('/vouchers', [VoucherController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('vouchers.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
