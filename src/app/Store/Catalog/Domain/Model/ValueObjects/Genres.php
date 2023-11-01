<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObjectArray;

final class Genres extends ValueObjectArray
{
    public readonly array $genres;

    public function __construct(array $genres)
    {
        parent::__construct($genres);

        $this->genres = array_values($genres);
    }

    public function __toString(): string
    {
        return implode(', ', $this->genres);
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
