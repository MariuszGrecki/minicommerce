<?php

namespace App\Services\Messaging;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class RabbitMqPublisher
{
    public function connect(): AMQPStreamConnection
    {
        return new AMQPStreamConnection(
            config('services.rabbitmq.host'),
            config('services.rabbitmq.port'),
            config('services.rabbitmq.user'),
            config('services.rabbitmq.password')
        );
    }

public function publish(string $routingKey, array $payload): void
{
    $connection = $this->connect();
    $channel = null;

    try {
        $channel = $connection->channel();

        $channel->confirm_select();

        $json = json_encode($payload, JSON_THROW_ON_ERROR);

        $message = new AMQPMessage($json, [
            'content_type' => 'application/json',
            'delivery_mode' => 2,
        ]);

        $channel->basic_publish(
            $message,
            'commerce.events',
            $routingKey
        );

        $channel->wait_for_pending_acks_returns(5.0);

    } finally {
        if ($channel !== null && $channel->is_open()) {
            $channel->close();
        }

        if ($connection->isConnected()) {
            $connection->close();
        }
    }
}
}
