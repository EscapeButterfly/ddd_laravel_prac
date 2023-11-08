<?php

namespace App\Store\Catalog\Application\Exceptions;

class BookAlreadyExistsException extends \DomainException
{
    public function __construct()
    {
        parent::__construct('Book with given ISBN already exists in catalog.');
    }
}
