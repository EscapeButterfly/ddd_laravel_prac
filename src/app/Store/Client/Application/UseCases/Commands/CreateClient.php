<?php

namespace App\Store\Client\Application\UseCases\Commands;

use App\Store\Client\Application\DTO\ClientData;
use App\Store\Client\Domain\Repositories\ClientRepositoryInterface;
use App\Store\Common\Domain\CommandInterface;
use Illuminate\Support\Str;

class CreateClient implements CommandInterface
{
    private ClientRepositoryInterface $repository;
    private string                    $uuid;

    public function __construct(
        private readonly ClientData $clientData
    )
    {
        $this->uuid       = Str::uuid()->toString();
        $this->repository = app()->make(ClientRepositoryInterface::class);
    }

    public function execute(): void
    {
        $this->repository->create($this->clientData, $this->uuid);
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
