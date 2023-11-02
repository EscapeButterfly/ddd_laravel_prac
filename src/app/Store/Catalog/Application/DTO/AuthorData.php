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
        public readonly string     $uuid,
        public readonly FirstName  $firstName,
        public readonly SecondName $secondName,
        public readonly BirthDate  $birthDate,
        public readonly Biography  $biography
    )
    {
    }

    public static function fromRequest(Request $request, string $uuid): AuthorData
    {
        return new self(
            uuid      : $uuid,
            firstName : new FirstName($request->input('first_name')),
            secondName: new SecondName($request->input('second_name')),
            birthDate : new BirthDate(Carbon::parse($request->input('birth_date'))->toDateTimeImmutable()),
            biography : new Biography($request->input('biography'))
        );
    }

    public static function fromEloquent(Author $author): AuthorData
    {
        return new self(
            uuid      : $author->uuid,
            firstName : new FirstName($author->first_name),
            secondName: new SecondName($author->second_name),
            birthDate : new BirthDate($author->birth_date),
            biography : new Biography($author->bio)
        );
    }

    public function toArray(): array
    {
        return [
            'uuid'       => $this->uuid,
            'firstName'  => $this->firstName,
            'secondName' => $this->secondName,
            'birthDate'  => $this->birthDate,
            'biography'  => $this->biography,
        ];
    }
}