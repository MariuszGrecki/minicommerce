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
        $channel = $connection->channel();

        $json = json_encode($payload, JSON_THROW_ON_ERROR);

        $message = new AMQPMessage($json, [
            'content_type' => 'application/json',
            'delivery_mode' => 2
        ]);

        $channel->basic_publish(
            $message,
            'commerce.events',
            $routingKey
        );

        $channel->close();
        $connection->close();
    }
}
