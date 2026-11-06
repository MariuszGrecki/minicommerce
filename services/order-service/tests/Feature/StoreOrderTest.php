<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\Event;

class StoreOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_uses_test_database(): void
    {
        $database = \Illuminate\Support\Facades\DB::selectOne(
            'SELECT current_database() AS name'
        );

        $this->assertSame('orders_test', $database->name);
    }

    public function test_it_rejects_negative_order_amount(): void
    {
        $count = Order::count();

        $response = $this->postJson('/api/orders', [
            'customer_id' => 15,
            'total_amount' => -100.50,
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['total_amount']);

        $this->assertDatabaseCount('orders', $count);
    }

    public function test_it_creates_order(): void
    {
        Event::fake([OrderCreated::class]);
        $response = $this->postJson('/api/orders', [
            'customer_id' => 15,
            'total_amount' => '199.99',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('orders', [
            'customer_id' => 15,
            'total_amount' => '199.99'
        ]);

        $response->assertJsonPath('status', 'pending');
        $response->assertJsonStructure(['id', 'status']);
        $id = $response->json('id');
        $this->assertTrue(Str::isUuid($id, 7));
        Event::assertDispatched(OrderCreated::class);
    }
}
