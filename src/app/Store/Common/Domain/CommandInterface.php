<?php

namespace App\Store\Common\Domain;


interface CommandInterface
{
    public function execute();
}
