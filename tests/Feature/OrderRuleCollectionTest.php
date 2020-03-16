<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Services\Discount\OrderRuleCollection;
use App\Services\Discount\Rules\DiscountByProductCategory;
use App\Services\Discount\Rules\DiscountCheapestProductByCategory;
use App\Services\Discount\Rules\DiscountPercentageByTotalPrice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderRuleCollectionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testOrderRuleCollection()
    {
        $order = factory(Order::class)->make();
        $ruleCollection = new OrderRuleCollection($order);

        //base rules
        $this->assertEquals(count($ruleCollection->getRules()),3);
    }

    public function testOrderRuleCollectionAddRule()
    {
        $order = factory(Order::class)->make();
        $ruleCollection = new OrderRuleCollection($order);

        $extra = new DiscountPercentageByTotalPrice($order);
        $ruleCollection->addRule($extra);

        $this->assertEquals(count($ruleCollection->getRules()),4);
    }

    public function testOrderRuleDiscountByPriceInActive()
    {
        $order = factory(Order::class)->make([
            \App\Fields\Order::TOTAL => '999'
        ]);

        $discount = new DiscountPercentageByTotalPrice($order);

        $this->assertEquals($discount->isActive(),false);
    }

    public function testOrderRuleDiscountByPriceActive()
    {
        $order = factory(Order::class)->make([
            \App\Fields\Order::TOTAL => '1001'
        ]);

        $discount = new DiscountPercentageByTotalPrice($order);
        $discount->setPercentage(10);

        $this->assertEquals($discount->isActive(),true);
        $this->assertEquals($discount->amount(),(1001 * (10/100)));
    }

    public function testOrderRuleDiscountByCategory()
    {
        $orderItem = factory(OrderItem::class)->make([
            \App\Fields\OrderItem::PRODUCT_ID => 'B101'
        ]);

        $orderItem2 = factory(OrderItem::class)->make([
            \App\Fields\OrderItem::PRODUCT_ID => 'B102'
        ]);

        $orderItem3 = factory(OrderItem::class)->make([
            \App\Fields\OrderItem::PRODUCT_ID => 'A101'
        ]);

        $order = factory(Order::class)->make([
            \App\Fields\Order::ITEMS =>  [

                $orderItem->toArray(),
                $orderItem2->toArray(),
                $orderItem3->toArray()
            ]
        ]);

        $discount = new DiscountByProductCategory($order);
        $discount->setCategoryId(2);

        $amount1 = $discount->calculate($orderItem);
        $amount2 = $discount->calculate($orderItem2);

        $this->assertEquals($discount->amount(),($amount1 + $amount2));
    }

    public function testOrderRuleDiscountByCategoryQuantity()
    {
        $orderItem = factory(OrderItem::class)->make([
            \App\Fields\OrderItem::PRODUCT_ID => 'B101',
            \App\Fields\OrderItem::QUANTITY =>  5
        ]);

        $orderItem2 = factory(OrderItem::class)->make([
            \App\Fields\OrderItem::PRODUCT_ID => 'B102',
            \App\Fields\OrderItem::QUANTITY =>  6
        ]);

        $orderItem3 = factory(OrderItem::class)->make([
            \App\Fields\OrderItem::PRODUCT_ID => 'A101'
        ]);

        $order = factory(Order::class)->make([
            \App\Fields\Order::ITEMS =>  [

                $orderItem->toArray(),
                $orderItem2->toArray(),
                $orderItem3->toArray()
            ]
        ]);

        $discount = new DiscountByProductCategory($order);
        $discount->setCategoryId(2);

        $amount1 = $discount->calculate($orderItem);
        $amount2 = $discount->calculate($orderItem2);

        $this->assertEquals($discount->amount(),($amount1 + $amount2));
        $this->assertEquals((int)$amount1,0);
        $this->assertGreaterThan(0,$amount2);
    }

    public function testOrderRuleDiscountByCategoryCheapestProduct()
    {
        $orderItem = factory(OrderItem::class)->make([
            \App\Fields\OrderItem::PRODUCT_ID =>    'A101',
            \App\Fields\OrderItem::QUANTITY =>  3,
            \App\Fields\OrderItem::UNIT_PRICE =>  10,
            \App\Fields\OrderItem::TOTAL =>  30
        ]);

        $orderItem2 = factory(OrderItem::class)->make([
            \App\Fields\OrderItem::PRODUCT_ID   =>  'A102',
            \App\Fields\OrderItem::QUANTITY =>  3,
            \App\Fields\OrderItem::UNIT_PRICE =>  9,
            \App\Fields\OrderItem::TOTAL =>  27
        ]);

        $order = factory(Order::class)->make([
            \App\Fields\Order::ITEMS =>  [

                $orderItem->toArray(),
                $orderItem2->toArray()
            ]
        ]);

        $discount = new DiscountCheapestProductByCategory($order);
        $discount->setCategoryId(1);

        $cheapestProduct = $discount->getCheapesProduct($order->items);

        $this->assertEquals($orderItem2->toArray(),$cheapestProduct->toArray());
        $this->assertEquals($discount->amount(),$discount->calculate($orderItem2->{\App\Fields\OrderItem::TOTAL}));
    }
}
