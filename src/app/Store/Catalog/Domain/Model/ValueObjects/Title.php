<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class Title extends ValueObject
{
    public readonly string $title;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function jsonSerialize(): string
    {
        return $this->title;
    }
}
