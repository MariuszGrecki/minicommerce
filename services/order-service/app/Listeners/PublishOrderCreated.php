<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use App\Services\Messaging\RabbitMqPublisher;

class PublishOrderCreated
{
    /**
     * Create the event listener.
     */
    public function __construct(
        private readonly RabbitMqPublisher $publisher
    ) {}

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        $this->publisher->publish(
            'order.created',
            [
                'event' => 'order.created',
                'order_id' => $event->orderId
            ]
        );
    }
}
