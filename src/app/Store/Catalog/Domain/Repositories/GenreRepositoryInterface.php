<?php

namespace App\Store\Catalog\Domain\Repositories;

interface GenreRepositoryInterface
{
    public function findAll();
    public function findByUuid(string $uuid);
    public function findByGenre(string $genre);

    public function create();
    public function update();
    public function delete();
}
