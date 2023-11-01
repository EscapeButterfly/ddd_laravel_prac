<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Description extends ValueObject
{
    public readonly string $description;

    public function __construct(string $description)
    {
        $this->description = $description;
    }

    public function __toString(): string
    {
        return $this->description;
    }

    public function jsonSerialize(): string
    {
        return $this->description;
    }
}
