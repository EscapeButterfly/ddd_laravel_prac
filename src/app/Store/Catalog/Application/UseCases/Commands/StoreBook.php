<?php

namespace App\Store\Catalog\Application\UseCases\Commands;

use App\Store\Catalog\Application\DTO\BookData;
use App\Store\Catalog\Domain\Repositories\BookRepositoryInterface;
use App\Store\Common\Domain\CommandInterface;
use Illuminate\Support\Str;

class StoreBook implements CommandInterface
{
    private BookRepositoryInterface $repository;
    private string                  $uuid;

    public function __construct(
        private readonly BookData $bookData
    )
    {
        $this->uuid       = Str::uuid()->toString();
        $this->repository = app()->make(BookRepositoryInterface::class);
    }

    public function execute(): void
    {
        $this->repository->create($this->bookData, $this->uuid);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
