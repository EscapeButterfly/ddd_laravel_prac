<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\Entities;

use App\Store\Common\Domain\Entity;

class Genre extends Entity
{
    public function __construct(
        public readonly ?string $uuid,
        public readonly string $genre
    ) {}

    public function toArray(): array
    {
        return [
            'uuid'  => $this->uuid,
            'genre' => $this->genre
        ];
    }
}
