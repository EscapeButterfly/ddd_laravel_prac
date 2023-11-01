<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Factories;

use App\Store\Catalog\Domain\Model\Entities\Author;

class AuthorFactory
{
    public static function new(array $attributes = null): Author
    {
        $attributes = $attributes ?: [];

        $defaults = [
            'uuid' => fake()->uuid(),
            'first_name' => fake()->firstName(),
            'second_name' => fake()->
        ];

    }
}
