?php

use App\Http\Controllers\PortalController;
use Illuminate\Support\Facades\Route;

Route::post('/mercadopago/webhook', [PortalController::class, 'webhook'])
    ->name('mercadopago.webhook');

Route::post('/webhook/mercadopago', [PortalController::class, 'webhook']);
