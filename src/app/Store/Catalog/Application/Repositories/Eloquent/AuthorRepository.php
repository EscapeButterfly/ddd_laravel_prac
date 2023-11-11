<?php

namespace App\Store\Catalog\Application\Repositories\Eloquent;

use App\Store\Catalog\Application\DTO\AuthorData;
use App\Store\Catalog\Application\Mappers\AuthorMapper;
use App\Store\Catalog\Domain\Model\Entities\Author as AuthorEntity;
use App\Store\Catalog\Domain\Repositories\AuthorRepositoryInterface;
use App\Store\Catalog\Infrastructure\EloquentModels\Author;
use Illuminate\Support\Facades\DB;

class AuthorRepository implements AuthorRepositoryInterface
{
    public function findAll(): array
    {
        $authorCollection = Author::all();
        return $authorCollection->map(function ($author) {
            return AuthorMapper::fromEloquent($author);
        })->toArray();
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

    public function findByUuids(array $uuids): array
    {
        return Author::query()
            ->whereIn('uuid', $uuids)
            ->get()
            ->map(function ($author) {
                return AuthorMapper::fromEloquent($author);
            })->toArray();
    }

    public function search(array $params = null): array
    {
        $query = Author::query();

        if ($params) {
            foreach ($params as $key => $value) {
                $query->where($key, $value);
            }
        }

        return $query->get()->map(function ($author) {
            return AuthorMapper::fromEloquent($author);
        })->toArray();
    }

    public function create(AuthorData $authorData, ?string $uuid): AuthorEntity
    {
        $author = new Author(['uuid' => $uuid]);
        $author->fill($authorData->toArray());
        $author->save();
        return AuthorMapper::fromEloquent($author);
    }

    public function update(AuthorData $authorData, string $uuid): void
    {
        $authorArray    = $authorData->toArray();
        $authorEloquent = Author::query()->findOrFail($uuid);
        $authorEloquent->fill($authorArray);
        $authorEloquent->save();
    }

    public function delete(string $uuid): void
    {
        $authorEloquent = Author::query()->findOrFail($uuid);
        $authorEloquent->delete();
    }

}
