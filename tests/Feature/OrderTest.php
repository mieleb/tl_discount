<?php

namespace Tests\Feature;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testOrderStructure()
    {
        $orderData = factory(Order::class)->make();

        $model = new Order();
        $record = $model->fill($orderData->toArray());

        $this->assertEquals($orderData->{\App\Fields\Order::ID},$record->{\App\Fields\Order::ID});
        $this->assertEquals($orderData->{\App\Fields\Order::TOTAL},$record->{\App\Fields\Order::TOTAL});
        $this->assertEquals($orderData->{\App\Fields\Order::CUSTOMER_ID},$record->{\App\Fields\Order::CUSTOMER_ID});
        $this->assertEquals($orderData->items->count(),$record->items->count());
    }
}
