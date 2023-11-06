<?php

namespace App\Store\Catalog\Presentation\HTTP;

use App\Store\Catalog\Application\DTO\AuthorData;
use App\Store\Catalog\Application\Mappers\AuthorMapper;
use App\Store\Catalog\Application\UseCases\Commands\DeleteAuthor;
use App\Store\Catalog\Application\UseCases\Commands\StoreAuthor;
use App\Store\Catalog\Application\UseCases\Commands\UpdateAuthor;
use App\Store\Catalog\Application\UseCases\Queries\FindAllAuthors;
use App\Store\Catalog\Application\UseCases\Queries\FindAuthorByName;
use App\Store\Catalog\Application\UseCases\Queries\GetAuthorByUuid;
use App\Store\Catalog\Application\UseCases\Queries\SearchAuthors;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorController
{
    public function add(Request $request): JsonResponse
    {
        $authorEntity = AuthorMapper::fromRequest($request);
        $author       = (new StoreAuthor($authorEntity))->execute();
        return response()->json($author->toArray());
    }

    public function update(Request $request, string $uuid): JsonResponse
    {
        $authorData = AuthorData::fromRequest($request, $uuid);
        (new UpdateAuthor($authorData))->execute();
        return response()->json($authorData->toArray());
    }

    public function delete(string $uuid): JsonResponse
    {
        (new DeleteAuthor($uuid))->execute();
        return response()->json();
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
