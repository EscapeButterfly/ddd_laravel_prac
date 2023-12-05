<?php

use App\Store\Order\Presentation\HTTP\Controllers\OrderController;

Route::group([
    'prefix' => 'orders'
], function () {
    Route::put('create', [OrderController::class, 'create']);
});
