<?php

namespace App\Store\Catalog\Presentation\HTTP\Controllers;

use App\Store\Catalog\Application\DTO\AuthorData;
use App\Store\Catalog\Application\Exceptions\AuthorAlreadyExistsException;
use App\Store\Catalog\Application\UseCases\Commands\DeleteAuthor;
use App\Store\Catalog\Application\UseCases\Commands\StoreAuthor;
use App\Store\Catalog\Application\UseCases\Commands\UpdateAuthor;
use App\Store\Catalog\Application\UseCases\Queries\FindAllAuthors;
use App\Store\Catalog\Application\UseCases\Queries\FindAuthorByName;
use App\Store\Catalog\Application\UseCases\Queries\GetAuthorByUuid;
use App\Store\Catalog\Application\UseCases\Queries\SearchAuthors;
use App\Store\Catalog\Presentation\HTTP\Requests\CreateAuthorRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController
{
    public function create(CreateAuthorRequest $request): JsonResponse
    {
        try {
            $authorData         = AuthorData::fromRequest($request);
            $storeAuthorCommand = new StoreAuthor($authorData);
            $storeAuthorCommand->execute();
            $authorUuid = $storeAuthorCommand->getUuid();
            $author     = (new GetAuthorByUuid($authorUuid))->handle();
            return response()->json($author->toArray());
        } catch (AuthorAlreadyExistsException $exception) {
            return response()->json($exception->getMessage(), 400);
        }
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        try {
            $authorData = AuthorData::fromRequest($request);
            (new UpdateAuthor($authorData, $uuid))->execute();
            $author     = (new GetAuthorByUuid($uuid))->handle();
            return response()->json($author->toArray());
        } catch (ModelNotFoundException $exception) {
            return response()->json($exception->getMessage(), 404);
        }
    }

    public function delete(string $uuid): JsonResponse
    {
        try {
            (new DeleteAuthor($uuid))->execute();
            return response()->json();
        } catch (ModelNotFoundException $exception) {
            return response()->json($exception->getMessage(), 404);
        }
    }

    public function all(): JsonResponse
    {
        $authors = (new FindAllAuthors())->handle();
        return response()->json($authors);
    }

    public function get(string $uuid): JsonResponse
    {
        $author = (new GetAuthorByUuid($uuid))->handle();
        return response()->json($author->toArray());
    }

    public function search(Request $request): JsonResponse
    {
        $query   = $request->all();
        $authors = (new SearchAuthors($query))->handle();
        return response()->json($authors);
    }

    public function findByName(string $name): JsonResponse
    {
        $author = (new FindAuthorByName($name))->handle();
        return response()->json($author->toArray());
    }
}
