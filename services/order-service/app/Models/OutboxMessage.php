<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class OutboxMessage extends Model
{
    use HasUuids;

    protected $fillable = [
        'event_type',
        'payload',
        'published_at'
    ];

    protected function casts(): array {
        return [
            'payload' => 'array',
            'published_at' => 'datetime',
        ];
    }
}
