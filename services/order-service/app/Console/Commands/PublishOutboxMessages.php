<?php

namespace App\Console\Commands;

use App\Models\OutboxMessage;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Services\Messaging\RabbitMqPublisher;

#[Signature('outbox:publish')]

#[Description('Publish pending outbox messages to RabbitMQ')]

class PublishOutboxMessages extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(RabbitMqPublisher $publisher): int
    {
        $messages = OutboxMessage::query()
            ->whereNull('published_at')
            ->orderBy('created_at')
            ->limit(10)
            ->get();

        foreach ($messages as $message) {
            $this->info("Unpublished message: {$message->id}");

            $publisher->publish(
                $message->event_type,
                $message->payload
            );

            $message->update([
                'published_at' => now()
            ]);
        }

        return self::SUCCESS;
    }
}
