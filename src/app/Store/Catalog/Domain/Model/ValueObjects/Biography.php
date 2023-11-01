<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Biography extends ValueObject
{
    public readonly string $biography;

    public function __construct(string $biography)
    {
        $this->biography = $biography;
    }

    public function jsonSerialize(): string
    {
        return $this->biography;
    }
}
