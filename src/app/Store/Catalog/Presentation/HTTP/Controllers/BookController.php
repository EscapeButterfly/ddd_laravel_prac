<?php

namespace App\Store\Catalog\Presentation\HTTP\Controllers;

use App\Store\Catalog\Application\DTO\BookData;
use App\Store\Catalog\Application\Exceptions\BookAlreadyExistsException;
use App\Store\Catalog\Application\UseCases\Commands\DeleteBook;
use App\Store\Catalog\Application\UseCases\Commands\StoreBook;
use App\Store\Catalog\Application\UseCases\Commands\UpdateBook;
use App\Store\Catalog\Application\UseCases\Queries\FindAllBooks;
use App\Store\Catalog\Application\UseCases\Queries\FindBookByIsbn;
use App\Store\Catalog\Application\UseCases\Queries\FindBookByTitle;
use App\Store\Catalog\Application\UseCases\Queries\FindBookByUuid;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController
{
    public function create(Request $request): JsonResponse
    {
        try {
            $bookData         = BookData::fromRequest($request);
            $storeBookCommand = new StoreBook($bookData);
            $storeBookCommand->execute();
            $book = (new FindBookByUuid($storeBookCommand->getUuid()))->handle();
            return response()->json($book->toArray());
        } catch (BookAlreadyExistsException $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        try {
            $bookData          = BookData::fromRequest($request);
            $updateBookCommand = new UpdateBook($bookData, $uuid);
            $updateBookCommand->execute();
            $book = (new FindBookByUuid($uuid))->handle();
            return response()->json($book->toArray());
        } catch (ModelNotFoundException $exception) {
            return response()->json($exception->getMessage(), 404);
        }
    }

    public function delete(string $uuid): JsonResponse
    {
        try {
            (new DeleteBook($uuid))->execute();
            return response()->json();
        } catch (ModelNotFoundException $exception) {
            return response()->json($exception->getMessage(), 404);
        }
    }

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
        $books = (new FindBookByTitle($title))->handle();
        return response()->json($books);
    }


}