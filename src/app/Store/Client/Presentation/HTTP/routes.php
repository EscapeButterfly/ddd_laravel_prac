<?php


use Illuminate\Support\Facades\Route;
use App\Store\Client\Presentation\HTTP\Controllers\ClientController;

Route::group([
    'prefix' => 'clients'
], function () {
    Route::put('create', [ClientController::class, 'create']);
    Route::patch('update/{uuid}', [ClientController::class, 'update']);
    Route::delete('{uuid}', [ClientController::class, 'delete']);
    Route::get('{uuid}', [ClientController::class, 'getByUuid']);
    Route::get('search', [ClientController::class, 'search']);
});
