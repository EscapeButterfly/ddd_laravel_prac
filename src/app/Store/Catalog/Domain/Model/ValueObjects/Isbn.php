<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Isbn extends ValueObject
{
    public readonly string $isbn;

    public function __construct(string $isbn)
    {
        $this->isbn = $isbn;
    }

    public function __toString(): string
    {
        return $this->isbn;
    }

    public function jsonSerialize(): string
    {
        return $this->isbn;
    }
}
