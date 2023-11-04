<?php

namespace App\Store\Catalog\Domain\Factories;


use App\Store\Catalog\Domain\Model\Entities\Genre;
use App\Store\Catalog\Domain\Model\ValueObjects\Genre as GenreValueObject;

class GenreFactory
{
    public static function new(array $attributes = null): Genre
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'uuid'  => fake()->uuid(),
            'genre' => fake()->domainWord
        ];

        $attributes = array_replace($defaults, $attributes);

        return new Genre(
            uuid : $attributes['uuid'],
            genre: new GenreValueObject($attributes['genre'])
        );
    }
}
