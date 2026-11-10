<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Support\Facades\Log;


class LogOrderCreated
{
    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        Log::info('Order created', [
            'order_id' => $event->orderId
        ]);
    }
}
