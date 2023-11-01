<?php

declare(strict_types=1);

namespace App\Store\Catalog\Domain\Factories;

use App\Store\Catalog\Domain\Model\Entities\Author;
use App\Store\Catalog\Domain\Model\ValueObjects\Biography;
use App\Store\Catalog\Domain\Model\ValueObjects\BirthDate;
use App\Store\Catalog\Domain\Model\ValueObjects\FirstName;
use App\Store\Catalog\Domain\Model\ValueObjects\SecondName;
use Illuminate\Support\Carbon;

class AuthorFactory
{
    public static function new(array $attributes = null): Author
    {
        $attributes = $attributes ?: [];

        $birthDateCarbon = Carbon::createFromTimestamp(fake()->dateTimeBetween('-200 years', '-20 years')->getTimestamp());
        $defaults = [
            'uuid'        => fake()->uuid(),
            'first_name'  => fake()->firstName(),
            'second_name' => fake()->lastName(),
            'birth_date'  => $birthDateCarbon->toDateTimeImmutable(),
            'biography'   => fake()->text(500)
        ];

        $attributes = array_replace($defaults, $attributes);

        return new Author(
            uuid      : $attributes['uuid'],
            firstName : new FirstName($attributes['first_name']),
            secondName: new SecondName($attributes['second_name']),
            birthDate : new BirthDate($attributes['birth_date']),
            biography : new Biography($attributes['biography'])
        );
    }
}
