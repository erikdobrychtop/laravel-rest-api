<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\TravelOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TravelOrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_travel_order()
    {
        $user = User::factory()->create();
        $token = auth('api')->login($user);

        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->postJson('/api/travel-orders', [
                             'requester_name' => 'John Doe',
                             'destination' => 'New York',
                             'departure_date' => '2025-05-01',
                             'return_date' => '2025-05-05',
                         ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['destination' => 'New York']);
    }

    public function test_update_status_forbidden_for_requester()
    {
        $user = User::factory()->create();
        $token = auth('api')->login($user);
        $travelOrder = TravelOrder::factory()->create(['user_id' => $user->id]);

        $response = $this->withHeader('Authorization', "Bearer $token")
                         ->putJson("/api/travel-orders/{$travelOrder->id}/status", ['status' => 'approved']);

        $response->assertStatus(403);
    }
}