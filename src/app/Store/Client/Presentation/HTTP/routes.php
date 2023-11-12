<?php


use Illuminate\Support\Facades\Route;
use App\Store\Client\Presentation\HTTP\Controllers\ClientController;

Route::group([
    'prefix' => 'clients'
], function () {
    Route::put('create', [ClientController::class, 'create']);
});
