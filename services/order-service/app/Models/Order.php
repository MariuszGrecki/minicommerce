<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Order extends Model
{
    use HasUuids;

    protected $fillable = [
        'customer_id',
        'total_amount',
    ];

    protected function casts(): array {
        return [
            'total_amount' => 'decimal:2',
        ];
    }
}
