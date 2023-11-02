<?php

namespace App\Store\Catalog\Application\Repositories\Eloquent;

use App\Store\Catalog\Application\DTO\AuthorData;
use App\Store\Catalog\Application\Mappers\AuthorMapper;
use App\Store\Catalog\Domain\Model\Entities\Author as AuthorEntity;
use App\Store\Catalog\Domain\Repositories\AuthorRepositoryInterface;
use App\Store\Catalog\Infrastructure\EloquentModels\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function findAll(): Collection
    {
        return Author::all();
    }

    public function findByUuid(string $uuid): AuthorEntity
    {
        /** @var Author $authorEloquent */
        $authorEloquent = Author::query()->findOrFail($uuid);
        return AuthorMapper::fromEloquent($authorEloquent);
    }

    public function findByName(string $name): AuthorEntity
    {
        /** @var Author $authorEloquent */
        $authorEloquent = Author::query()
            ->where('first_name', 'LIKE', "%$name%")
            ->orWhere('second_name', 'LIKE', "%$name%")
            ->orWhere(DB::raw("concat(first_name, ' ', second_name)"), 'LIKE', "%$name%")
            ->firstOrFail();
        return AuthorMapper::fromEloquent($authorEloquent);
    }

    public function create(AuthorEntity $author): AuthorData
    {
        $authorEloquent = AuthorMapper::toEloquent($author);
        $authorEloquent->save();
        return AuthorData::fromEloquent($authorEloquent);
    }

    public function update(AuthorData $authorData): void
    {
        $authorArray    = $authorData->toArray();
        $authorEloquent = Author::query()->findOrFail($authorArray['uuid']);
        $authorEloquent->fill($authorArray);
        $authorEloquent->save();
    }

    public function delete(string $uuid): void
    {
        $authorEloquent = Author::query()->findOrFail($uuid);
        $authorEloquent->delete();
    }

}
