<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(): JsonResponse
    {
        return response()->json([
            'message' => 'order endpoint works',
        ], 200);
    }
}
