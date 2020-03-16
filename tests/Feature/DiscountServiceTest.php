<?php

namespace Tests\Feature;

use App\Services\Discount\OrderDiscountService;
use App\Services\Discount\OrderRuleCollection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;

class DiscountServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDiscountService()
    {
        $order = factory(Order::class)->make([
            \App\Fields\Order::TOTAL    =>  1001
        ]);
        $ruleCollection = new OrderRuleCollection($order);

        $service = new OrderDiscountService($ruleCollection);
        $service->apply();

        $this->assertEquals(count($service->getActiveDiscounts()),1);
    }
}
