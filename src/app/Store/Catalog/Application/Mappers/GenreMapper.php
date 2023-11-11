<?php

namespace App\Store\Catalog\Application\Mappers;

use App\Store\Catalog\Domain\Model\Entities\Genre as GenreEntity;
use App\Store\Catalog\Domain\Model\ValueObjects\Genre as GenreValueObject;
use App\Store\Catalog\Infrastructure\EloquentModels\Genre;

class GenreMapper
{
    public static function fromEloquent(Genre $genre): GenreEntity
    {
        return new GenreEntity(
            uuid : $genre->uuid,
            genre: new GenreValueObject($genre->genre)
        );
    }
}
