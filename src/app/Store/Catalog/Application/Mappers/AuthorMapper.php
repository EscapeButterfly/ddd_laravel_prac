<?php

namespace App\Store\Catalog\Application\Mappers;

use App\Store\Catalog\Domain\Model\Entities\Author;
use App\Store\Catalog\Domain\Model\ValueObjects\Biography;
use App\Store\Catalog\Domain\Model\ValueObjects\BirthDate;
use App\Store\Catalog\Domain\Model\ValueObjects\FirstName;
use App\Store\Catalog\Domain\Model\ValueObjects\LastName;
use App\Store\Catalog\Infrastructure\EloquentModels\Author as AuthorEloquent;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AuthorMapper
{
    public static function fromRequest(Request $request, ?string $uuid = null): Author
    {
        return new Author(
            uuid     : $uuid,
            firstName: new FirstName($request->input('first_name')),
            lastName : new LastName($request->input('last_name')),
            birthDate: new BirthDate(Carbon::parse($request->input('birth_date'))->toDateTimeImmutable()),
            biography: new Biography($request->input('biography'))
        );
    }

    public static function fromEloquent(AuthorEloquent $author): Author
    {
        return new Author(
            uuid     : $author->uuid,
            firstName: new FirstName($author->first_name),
            lastName : new LastName($author->last_name),
            birthDate: new BirthDate(Carbon::parse($author->birth_date)->toDateTimeImmutable()),
            biography: new Biography($author->bio)
        );
    }

    public static function fromArray(array $author): Author
    {
        $authorEloquentModel       = new AuthorEloquent($author);
        $authorEloquentModel->uuid = $author['uuid'] ?? null;
        return self::fromEloquent($authorEloquentModel);
    }

    public static function toEloquent(Author $author): AuthorEloquent
    {
        $authorEloquentModel = new AuthorEloquent();
        if ($author->uuid) {
            $authorEloquentModel = AuthorEloquent::query()->findOrFail($author->uuid);
        }
        $authorEloquentModel->first_name = $author->firstName->value;
        $authorEloquentModel->last_name  = $author->lastName->value;
        $authorEloquentModel->birth_date = $author->birthDate->value;
        $authorEloquentModel->bio        = $author->biography->value;

        return $authorEloquentModel;
    }
}
