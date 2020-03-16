<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DiscountRequestTest extends TestCase
{

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\ApiUser::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDiscountEndpoint()
    {
        $response = $this->get(route('api.discount'));
        $response->assertStatus(405);

        $response = $this->post(route('api.discount'));
        $response->assertStatus(302);

        $response = $this->postRequest([]);
        $response->assertStatus(422);
    }

    public function testDiscountRequest()
    {
        $order = factory(Order::class)->make();
        $response = $this->postRequest($order->toArray());

        $response->assertStatus(200);
    }
}
