<?php

namespace App\Store\Catalog\Application\Mappers;

use App\Store\Catalog\Domain\Model\Entities\Genre as GenreEntity;
use App\Store\Catalog\Domain\Model\ValueObjects\Genre;
use App\Store\Catalog\Infrastructure\EloquentModels\Genre as GenreEloquent;
use Illuminate\Http\Request;

class GenreMapper
{
    public static function fromRequest(Request $request, string $uuid): GenreEntity
    {
        return new GenreEntity(
            uuid : $uuid,
            genre: new Genre($request->input('genre'))
        );
    }

    public static function fromEloquent(GenreEloquent $genre): GenreEntity
    {
        return new GenreEntity(
            uuid : $genre->uuid,
            genre: new Genre($genre->genre)
        );
    }

    public static function fromArray(array $genre): GenreEntity
    {
        return new GenreEntity(
            uuid : $genre['uuid'],
            genre: $genre['genre']
        );
    }

    public static function toEloquent(GenreEntity $genre): GenreEloquent
    {
        $genreEloquent = new GenreEloquent();
        if ($genre->uuid) {
            $genreEloquent = GenreEloquent::query()->findOrFail($genre->uuid);
        }
        $genreEloquent->genre = $genre->genre;
        return $genreEloquent;
    }
}
