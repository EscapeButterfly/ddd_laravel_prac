<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Model\ValueObjects;

use DateTimeImmutable;
use App\Store\Common\Domain\ValueObject;

final class PublishDate extends ValueObject
{
    public readonly DateTimeImmutable $publishDate;

    public function __construct(DateTimeImmutable $publishDate)
    {
        $this->publishDate = $publishDate;
    }

    public function jsonSerialize(): string
    {
        return $this->publishDate->format('Y-m-d');
    }
}
