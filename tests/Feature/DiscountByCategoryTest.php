<?php

namespace Tests\Feature;

use App\Services\Discount\Rules\DiscountByProductCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;

use Mockery\Mock;

class DiscountByCategoryTest extends TestCase
{

    public function testClassProperties()
    {
        $order = factory(Order::class)->make();
        $combiAmount = 10;

        $mock = $this->getMockBuilder(DiscountByProductCategory::class)
            ->setConstructorArgs([$order])
            ->onlyMethods(['setCombiAmount','getCombiAmount'])
            ->getMock();

        $mock->expects($this->once())
            ->method('setCombiAmount')
            ->willReturnCallback(function($arg) use($mock){
                $mock->combiAmount = $arg;
            });

        $mock->setCombiAmount($combiAmount);

        $mock->expects($this->once())
                ->method('getCombiAmount')
                ->willReturn($combiAmount);

        $amount = $mock->getCombiAmount();

        $this->assertEquals($combiAmount,$amount);
    }
}
