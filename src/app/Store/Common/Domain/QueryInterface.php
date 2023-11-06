<?php

namespace App\Store\Common\Domain;

interface QueryInterface
{
    public function handle(): mixed;
}
