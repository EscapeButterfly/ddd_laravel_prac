<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Pages extends ValueObject
{
    public readonly int $value;

    public function __construct(int $pages)
    {
        $this->value = $pages;
    }

    public function jsonSerialize(): int
    {
        return $this->value;
    }
}
