<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Catalog\Domain\Exception\NotValidGenreException;
use App\Store\Common\Domain\ValueObjectArray;
use App\Store\Catalog\Domain\Model\Entities\Genre;


final class Genres extends ValueObjectArray
{
    public readonly array $genres;

    public function __construct(array $genres)
    {
        parent::__construct($genres);

        foreach ($genres as $genre) {
            if (!$genre instanceof Genre) {
                throw new NotValidGenreException;
            }
        }

        $this->genres = $genres;
    }

    public function toArray(): array
    {
        return $this->genres;
    }

    public function jsonSerialize(): array
    {
        return $this->genres;
    }
}
