<?php

namespace App\Actions;

use App\Models\Order;
use App\Models\OutboxMessage;
use Illuminate\Support\Facades\DB;

final class CreateOrderAction
{
    public function execute(array $data): Order
    {
        $order = DB::transaction(function () use ($data) {
            $order = Order::create($data);
            $order->refresh();

            OutboxMessage::create([
                'event_type' => 'order.created',
                'payload' => [
                    'order_id' => $order->id,
                    'customer_id' => $order->customer_id,
                    'total_amount' => $order->total_amount
                ],
            ]);

            return $order;
        });

        return $order;
    }
}
