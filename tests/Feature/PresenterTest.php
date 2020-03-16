<?php

namespace Tests\Feature;

use App\Presenters\DiscountPresenter;
use App\Services\Discount\Rules\DiscountPercentageByTotalPrice;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;

class PresenterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPresenter()
    {
        $order = factory(Order::class)->make();
        $discount = new DiscountPercentageByTotalPrice($order);

        $presenter = new DiscountPresenter($discount,0);

        $this->assertEquals($presenter->message(),$discount->message());
        $this->assertEquals($presenter->amount(),$discount->amount());
    }
}
