<?php

namespace App\Store\Catalog\Domain\Repositories;

interface AuthorRepositoryInterface
{
    public function findAll();
    public function findByUuid(string $uuid);
    public function findByName();
    public function create();
    public function update();
    public function delete();
}
