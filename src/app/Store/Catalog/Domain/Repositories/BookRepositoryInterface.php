<?php

namespace App\Store\Catalog\Domain\Repositories;

interface BookRepositoryInterface
{
    public function findAll();
    public function findByUuid();
    public function findByIsbn();
    public function findByTitle();

    public function create();
    public function update();
    public function delete();
}
