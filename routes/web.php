<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/admin.php';
require __DIR__ . '/portal.php';
require __DIR__ . '/webhooks.php';
require __DIR__ . '/auth.php';
