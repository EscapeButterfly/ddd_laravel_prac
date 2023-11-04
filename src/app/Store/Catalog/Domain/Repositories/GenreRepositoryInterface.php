<?php

namespace App\Store\Catalog\Domain\Repositories;

use App\Store\Catalog\Application\DTO\GenreData;
use App\Store\Catalog\Domain\Model\Entities\Genre as GenreEntity;
use App\Store\Catalog\Infrastructure\EloquentModels\Genre;
use Illuminate\Database\Eloquent\Collection;

interface GenreRepositoryInterface
{
    public function findAll(): Collection;

    public function findByUuid(string $uuid): Genre;

    public function findByGenre(string $genre): Genre;

    public function create(GenreEntity $genre): GenreData;

    public function update(GenreData $genreData): void;

    public function delete(string $uuid): void;
}
