<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use App\Store\Common\Domain\ValueObject;

final class SecondName extends ValueObject
{
    public readonly string $secondName;

    public function __construct(string $secondName)
    {
        $this->secondName = $secondName;
    }

    public function jsonSerialize(): string
    {
        return $this->secondName;
    }
}
