<?php

namespace App\Store\Client\Application\UseCases\Queries;

use App\Store\Client\Domain\Model\Client;
use App\Store\Client\Domain\Repositories\ClientRepositoryInterface;
use App\Store\Common\Domain\QueryInterface;

class FindClientByUuid implements QueryInterface
{
    private ClientRepositoryInterface $repository;

    public function __construct(
        private readonly string $uuid
    )
    {
        $this->repository = app()->make(ClientRepositoryInterface::class);
    }

    public function handle(): Client
    {
        return $this->repository->getByUuid($this->uuid);
    }
}
