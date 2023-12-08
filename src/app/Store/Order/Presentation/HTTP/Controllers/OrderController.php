<?php

namespace App\Store\Order\Presentation\HTTP\Controllers;

use App\Store\Order\Application\DTO\OrderData;
use App\Store\Order\Application\UseCases\Commands\CreateOrderCommand;
use App\Store\Order\Application\UseCases\Queries\GetOrderQuery;
use App\Store\Order\Presentation\HTTP\Requests\CreateOrderRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class OrderController
{
    public function create(CreateOrderRequest $request): JsonResponse
    {
        $orderData          = OrderData::fromRequest($request);
        $createOrderCommand = new CreateOrderCommand($orderData);
        $createOrderCommand->execute();
        $order = (new GetOrderQuery($createOrderCommand->getUuid()))->handle();
        return response()->json($order->toArray());
    }

    public function get(string $uuid): JsonResponse
    {
        try {
            $order = (new GetOrderQuery($uuid))->handle();
            return response()->json($order->toArray());
        } catch (ModelNotFoundException $exception) {
            return response()->json(['error' => $exception->getMessage()], 404);
        }
    }
}
