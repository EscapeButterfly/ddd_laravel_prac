<?php

namespace App\Store\Catalog\Domain\Exception;

use Throwable;

class NotValidAuthorException extends \DomainException
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Given author is not valid Author Entity.');
    }
}
