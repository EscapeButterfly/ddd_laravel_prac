<?php

namespace App\Store\Catalog\Application\DTO;

use App\Store\Catalog\Domain\Model\ValueObjects\Biography;
use App\Store\Catalog\Domain\Model\ValueObjects\BirthDate;
use App\Store\Catalog\Domain\Model\ValueObjects\FirstName;
use App\Store\Catalog\Domain\Model\ValueObjects\LastName;
use App\Store\Catalog\Infrastructure\EloquentModels\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AuthorData
{
    public function __construct(
        public readonly FirstName $firstName,
        public readonly LastName  $lastName,
        public readonly BirthDate $birthDate,
        public readonly Biography $biography
    )
    {
    }

    public static function fromRequest(Request $request): AuthorData
    {
        return new self(
            firstName: new FirstName($request->input('first_name')),
            lastName : new LastName($request->input('last_name')),
            birthDate: new BirthDate(Carbon::parse($request->input('birth_date'))->toDateTimeImmutable()),
            biography: new Biography($request->input('biography'))
        );
    }

    public static function fromEloquent(Author $author): AuthorData
    {
        return new self(
            firstName: new FirstName($author->first_name),
            lastName : new LastName($author->last_name),
            birthDate: new BirthDate($author->birth_date),
            biography: new Biography($author->bio)
        );
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName->value,
            'last_name'  => $this->lastName->value,
            'birth_date' => $this->birthDate->value->format('Y-m-d'),
            'bio'        => $this->biography->value,
        ];
    }
}
