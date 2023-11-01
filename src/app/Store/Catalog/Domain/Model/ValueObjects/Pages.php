<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Pages extends ValueObject
{
    public readonly int $pages;

    public function __construct(int $pages)
    {
        $this->pages = $pages;
    }

    public function jsonSerialize(): int
    {
        return $this->pages;
    }
}
