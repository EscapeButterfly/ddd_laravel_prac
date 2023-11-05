<?php

use App\Store\Catalog\Presentation\HTTP\AuthorController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'catalog'
], function () {
    Route::put('authors/add', [AuthorController::class, 'add']);
});
