<?php

namespace Tests\Feature;

use App\Http\Resources\DiscountItem;
use App\Presenters\DiscountPresenter;
use App\Services\Discount\Rules\DiscountPercentageByTotalPrice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;

class ResourceTest extends TestCase
{

    public function testResource()
    {
        $order = factory(Order::class)->make();
        $discount = new DiscountPercentageByTotalPrice($order);

        $presenter = new DiscountPresenter($discount,0);
        $resource = new DiscountItem($presenter);

        $resourceArray = $resource->toArray(request());

        $this->assertArrayHasKey('amount',$resourceArray);
        $this->assertArrayHasKey('message',$resourceArray);
    }
}
