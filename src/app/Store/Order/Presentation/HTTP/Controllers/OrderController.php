<?php

namespace App\Store\Order\Presentation\HTTP\Controllers;

use App\Store\Order\Presentation\HTTP\Requests\CreateOrderRequest;
use Illuminate\Http\JsonResponse;

class OrderController
{
    public function create(CreateOrderRequest $request): JsonResponse
    {

        return response()->json();
    }
}
