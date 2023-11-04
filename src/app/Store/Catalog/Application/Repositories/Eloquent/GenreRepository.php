<?php

namespace App\Store\Catalog\Application\Repositories\Eloquent;

use App\Store\Catalog\Application\DTO\GenreData;
use App\Store\Catalog\Application\Mappers\GenreMapper;
use App\Store\Catalog\Domain\Model\Entities\Genre as GenreEntity;
use App\Store\Catalog\Domain\Repositories\GenreRepositoryInterface;
use App\Store\Catalog\Infrastructure\EloquentModels\Genre;
use Illuminate\Database\Eloquent\Collection;

class GenreRepository implements GenreRepositoryInterface
{

    public function findAll(): Collection
    {
        return Genre::all();
    }

    public function findByUuid(string $uuid): Genre
    {
        /** @var Genre $genre */
        $genre = Genre::query()->findOrFail($uuid);
        return $genre;
    }

    public function findByGenre(string $genre): Genre
    {
        /** @var Genre $genre */
        $genre = Genre::query()->where('genre', $genre)->firstOrFail();
        return $genre;
    }

    public function create(GenreEntity $genre): GenreData
    {
        $genreEloquent = GenreMapper::toEloquent($genre);
        $genreEloquent->save();
        return GenreData::fromEloquent($genreEloquent);
    }

    public function update(GenreData $genreData): void
    {
        $genreArray    = $genreData->toArray();
        $genreEloquent = Genre::query()->findOrFail($genreArray['uuid']);
        $genreEloquent->fill($genreArray);
        $genreEloquent->save();
    }

    public function delete(string $uuid): void
    {
        $genreEloquent = Genre::query()->findOrFail($uuid);
        $genreEloquent->delete();
    }
}
