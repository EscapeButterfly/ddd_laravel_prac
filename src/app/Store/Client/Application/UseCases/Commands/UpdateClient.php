<?php

namespace App\Store\Client\Application\UseCases\Commands;

use App\Store\Client\Application\DTO\ClientData;
use App\Store\Client\Domain\Repositories\ClientRepositoryInterface;
use App\Store\Common\Domain\CommandInterface;

class UpdateClient implements CommandInterface
{
    private ClientRepositoryInterface $repository;

    public function __construct(
        private readonly ClientData $clientData,
        private readonly ?string $password,
        private readonly string $uuid
    )
    {
        $this->repository = app()->make(ClientRepositoryInterface::class);
    }

    public function execute(): void
    {
        $this->repository->update($this->clientData, $this->password, $this->uuid);
    }
}
