<?php

namespace App\Store\Client\Presentation\HTTP\Controllers;

use App\Store\Client\Application\DTO\ClientData;
use App\Store\Client\Application\UseCases\Commands\CreateClient;
use App\Store\Client\Application\UseCases\Queries\FindClientByUuid;
use App\Store\Client\Presentation\HTTP\Requests\CreateClientRequest;
use Illuminate\Http\JsonResponse;

class ClientController
{
    public function create(CreateClientRequest $request): JsonResponse
    {
        $clientData         = ClientData::fromRequest($request);
        $storeClientCommand = new CreateClient($clientData);
        $storeClientCommand->execute();
        $client = (new FindClientByUuid($storeClientCommand->getUuid()))->handle();
        return response()->json($client->toArray());
    }
}
