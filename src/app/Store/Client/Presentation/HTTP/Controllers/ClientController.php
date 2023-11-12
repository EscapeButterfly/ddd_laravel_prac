<?php

namespace App\Store\Client\Presentation\HTTP\Controllers;

use App\Store\Client\Application\DTO\ClientData;
use App\Store\Client\Application\UseCases\Commands\CreateClient;
use App\Store\Client\Application\UseCases\Commands\DeleteClient;
use App\Store\Client\Application\UseCases\Commands\UpdateClient;
use App\Store\Client\Application\UseCases\Queries\FindClientByUuid;
use App\Store\Client\Presentation\HTTP\Requests\CreateClientRequest;
use App\Store\Client\Presentation\HTTP\Requests\UpdateClientRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class ClientController
{
    public function create(CreateClientRequest $request): JsonResponse
    {
        $clientData         = ClientData::fromRequest($request);
        $storeClientCommand = new CreateClient($clientData, Hash::make($request->input('password')));
        $storeClientCommand->execute();
        $client = (new FindClientByUuid($storeClientCommand->getUuid()))->handle();
        return response()->json($client->toArray());
    }

    public function update(UpdateClientRequest $request, string $uuid): JsonResponse
    {
        try {
            $clientData = ClientData::fromRequest($request);
            $password   = $request->input('password') ? Hash::make($request->input('password')) : null;
            (new UpdateClient($clientData, $password, $uuid))->execute();
            $client = (new FindClientByUuid($uuid))->handle();
            return response()->json($client->toArray());
        } catch (ModelNotFoundException $exception) {
            return response()->json($exception->getMessage(), 404);
        }
    }

    public function delete(string $uuid): JsonResponse
    {
        try {
            (new DeleteClient($uuid))->execute();
            return response()->json();
        } catch (ModelNotFoundException $exception) {
            return response()->json($exception->getMessage(), 404);
        }
    }

    public function getByUuid(string $uuid): JsonResponse
    {
        try {
            $client = (new FindClientByUuid($uuid))->handle();
            return response()->json($client->toArray());
        } catch (ModelNotFoundException $exception) {
            return response()->json($exception->getMessage(), 404);
        }
    }
}
