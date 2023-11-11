<?php

use App\Store\Catalog\Presentation\HTTP\Controllers\AuthorController;
use App\Store\Catalog\Presentation\HTTP\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'catalog'
], function () {
    Route::group([
        'prefix' => 'authors'
    ], function () {
        Route::put('create', [AuthorController::class, 'create']);
        Route::patch('update/{uuid}', [AuthorController::class, 'update']);
        Route::delete('delete/{uuid}', [AuthorController::class, 'delete']);
        Route::get('all', [AuthorController::class, 'all']);
        Route::get('get/{uuid}', [AuthorController::class, 'get']);
        Route::get('search', [AuthorController::class, 'search']);
        Route::get('findByName/{name}', [AuthorController::class, 'findByName']);
    });

    Route::group([
        'prefix' => 'books'
    ], function () {
        Route::put('create', [BookController::class, 'create']);
        Route::patch('update/{uuid}', [BookController::class, 'update']);
        Route::delete('delete/{uuid}', [BookController::class, 'delete']);
        Route::get('all', [BookController::class, 'all']);
        Route::get('get/{uuid}', [BookController::class, 'get']);
        Route::get('findByIsbn/{isbn}', [BookController::class, 'getByIsbn']);
        Route::get('findByTitle/{title}', [BookController::class, 'getByTitle']);
        Route::get('genres', [BookController::class, 'getGenres']);
    });
});
