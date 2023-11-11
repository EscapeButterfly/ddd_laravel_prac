<?php

namespace App\Store\Catalog\Domain\Exception;

use Throwable;

class NotValidGenreException extends \DomainException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Given genre is not valid Genre Entity.');
    }
}
