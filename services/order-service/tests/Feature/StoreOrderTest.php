<?php

namespace Tests\Feature;

use Tests\TestCase;

class StoreOrderTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_it_rejects_negative_order_amount(): void
    {
        $response = $this->postJson('/api/orders', [
            'customer_id' => 15,
            'total_amount' => -100.50
        ]);

        $response->assertStatus(422);
    }
}
