<?php

use App\Http\Controllers\PortalController;
use Illuminate\Support\Facades\Route;

Route::get('/portal', function () {
    return view('portal.index');
})->name('portal');

Route::post('/portal/pagar', [PortalController::class, 'pagar'])
    ->name('portal.pagar');

Route::get('/wifi', function () {
    return view('wifi.index');
})->name('wifi');

Route::post('/wifi/pagar', [PortalController::class, 'pagar'])
    ->name('wifi.pagar');
