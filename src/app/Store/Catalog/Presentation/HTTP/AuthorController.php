<?php

namespace App\Store\Catalog\Presentation\HTTP;

use App\Store\Catalog\Application\Mappers\AuthorMapper;
use App\Store\Catalog\Application\UseCases\Commands\StoreAuthor;
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
}
