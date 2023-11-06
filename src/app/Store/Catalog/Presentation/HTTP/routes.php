<?php

use App\Store\Catalog\Presentation\HTTP\AuthorController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'catalog'
], function () {
    Route::put('authors/add', [AuthorController::class, 'add']);
    Route::patch('authors/update/{uuid}', [AuthorController::class, 'update']);
    Route::delete('authors/delete/{uuid}', [AuthorController::class, 'delete']);
    Route::get('authors/all', [AuthorController::class, 'all']);
    Route::get('authors/get/{uuid}', [AuthorController::class, 'get']);
    Route::get('authors/search', [AuthorController::class, 'search']);
    Route::get('authors/findByName/{name}', [AuthorController::class, 'findByName']);
});
