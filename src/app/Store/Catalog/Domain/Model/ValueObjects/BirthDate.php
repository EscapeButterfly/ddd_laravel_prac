<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use DateTimeImmutable;
use App\Store\Common\Domain\ValueObject;

final class BirthDate extends ValueObject
{
    public readonly DateTimeImmutable $birthDate;

    public function __construct(DateTimeImmutable $birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function jsonSerialize(): string
    {
        return $this->birthDate->format('Y-m-d');
    }
}
