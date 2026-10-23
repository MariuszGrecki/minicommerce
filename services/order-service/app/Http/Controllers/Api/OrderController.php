<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\StoreOrderRequest;

class OrderController extends Controller
{
    public function store(StoreOrderRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'order endpoint works',
        ], 200);
    }
}
