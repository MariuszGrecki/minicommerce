<?php

namespace App\Actions;

use App\Models\Order;

final class CreateOrderAction
{
    public function execute(array $data): Order
    {
        $order = Order::create($data);

        return $order->refresh();
    }
}
