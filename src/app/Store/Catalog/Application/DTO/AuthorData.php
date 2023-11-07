<?php

namespace App\Store\Catalog\Application\DTO;

use App\Store\Catalog\Domain\Model\ValueObjects\Biography;
use App\Store\Catalog\Domain\Model\ValueObjects\BirthDate;
use App\Store\Catalog\Domain\Model\ValueObjects\FirstName;
use App\Store\Catalog\Domain\Model\ValueObjects\SecondName;
use App\Store\Catalog\Infrastructure\EloquentModels\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AuthorData
{
    public function __construct(
        public readonly FirstName  $firstName,
        public readonly SecondName $secondName,
        public readonly BirthDate  $birthDate,
        public readonly Biography  $biography
    )
    {
    }

    public static function fromRequest(Request $request): AuthorData
    {
        return new self(
            firstName : new FirstName($request->input('first_name')),
            secondName: new SecondName($request->input('second_name')),
            birthDate : new BirthDate(Carbon::parse($request->input('birth_date'))->toDateTimeImmutable()),
            biography : new Biography($request->input('biography'))
        );
    }

    public static function fromEloquent(Author $author): AuthorData
    {
        return new self(
            firstName : new FirstName($author->first_name),
            secondName: new SecondName($author->second_name),
            birthDate : new BirthDate($author->birth_date),
            biography : new Biography($author->bio)
        );
    }

    public function toArray(): array
    {
        return [
            'first_name'  => $this->firstName->firstName,
            'second_name' => $this->secondName->secondName,
            'birth_date'  => $this->birthDate->birthDate->format('Y-m-d'),
            'bio'         => $this->biography->biography,
        ];
    }
}
