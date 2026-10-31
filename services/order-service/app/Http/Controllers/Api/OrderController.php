<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreOrderRequest;
use App\Actions\CreateOrderAction;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request, CreateOrderAction $action): JsonResponse
    {
        $data = $request->validated();

        $order = $action->execute($data);

        return response()->json([
            'id' => $order->id,
            'status' => $order->status
        ], 201);
    }
}
