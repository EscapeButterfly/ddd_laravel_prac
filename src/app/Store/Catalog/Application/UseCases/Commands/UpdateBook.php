<?php

namespace App\Store\Catalog\Application\UseCases\Commands;

use App\Store\Catalog\Application\DTO\BookData;
use App\Store\Catalog\Domain\Repositories\BookRepositoryInterface;
use App\Store\Common\Domain\CommandInterface;

class UpdateBook implements CommandInterface
{
    private BookRepositoryInterface $repository;

    public function __construct(
        private readonly BookData $bookData,
        private readonly string   $uuid
    )
    {
        $this->repository = app()->make(BookRepositoryInterface::class);
    }

    public function execute(): void
    {
        $this->repository->update($this->bookData, $this->uuid);
    }
}
