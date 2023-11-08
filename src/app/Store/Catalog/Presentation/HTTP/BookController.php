<?php

namespace App\Store\Catalog\Presentation\HTTP;

use App\Store\Catalog\Application\UseCases\Queries\FindAllBooks;
use App\Store\Catalog\Application\UseCases\Queries\FindBookByIsbn;
use App\Store\Catalog\Application\UseCases\Queries\FindBookByTitle;
use App\Store\Catalog\Application\UseCases\Queries\FindBookByUuid;
use Illuminate\Http\JsonResponse;

class BookController
{
    public function all(): JsonResponse
    {
        $books = (new FindAllBooks())->handle();
        return response()->json($books);
    }

    public function get(string $uuid): JsonResponse
    {
        $book = (new FindBookByUuid($uuid))->handle();
        return response()->json($book->toArray());
    }

    public function getByIsbn(string $isbn): JsonResponse
    {
        $book = (new FindBookByIsbn($isbn))->handle();
        return response()->json($book->toArray());
    }

    public function getByTitle(string $title): JsonResponse
    {
        $book = (new FindBookByTitle($title))->handle();
        return response()->json($book->toArray());
    }


}