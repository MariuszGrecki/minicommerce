<?php

namespace Tests\Feature;

use Tests\TestCase;

class StoreOrderTest extends TestCase
{
    public function test_it_uses_test_database(): void
    {
        $database = \Illuminate\Support\Facades\DB::selectOne(
            'SELECT current_database() AS name'
        );

        $this->assertSame('orders_test', $database->name);
    }

    public function test_it_rejects_negative_order_amount(): void
    {
        $response = $this->postJson('/api/orders', [
            'customer_id' => 15,
            'total_amount' => -100.50,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['total_amount']);
    }
}
