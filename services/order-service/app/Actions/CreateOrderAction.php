<?php

namespace App\Actions;

use App\Models\Order;
use App\Events\OrderCreated;

final class CreateOrderAction
{
    public function execute(array $data): Order
    {
        $order = Order::create($data);
        $order->refresh();

        OrderCreated::dispatch($order->id);

        return $order;
    }
}
