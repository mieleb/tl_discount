<?php

namespace Tests\Feature;

use App\Services\Discount\Rules\DiscountByProductCategory;
use App\Services\Discount\Rules\DiscountCheapestProductByCategory;
use App\Services\Discount\Rules\DiscountInterface;
use App\Services\Discount\Rules\DiscountPercentageByTotalPrice;
use App\Services\Discount\Types;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;

use App\Traits\NumberSpeller;

class DiscountTranslationTest extends TestCase
{
    use NumberSpeller;

    public function testTranslationTotalPrice()
    {
        $order = factory(Order::class)->make();

        $percentage = 5;
        $priceLimit = 50;

        $discount = new DiscountPercentageByTotalPrice($order);
        $discount->setPercentage($percentage);
        $discount->setPriceLimit($priceLimit);

        $this->assertEquals($discount->identifier(),Types::TOTAL_PRICE);

        $this->translationCompare($discount,[
           'price_limit'    =>  $priceLimit,
           'percentage' =>  $percentage,
        ]);
    }

    public function testTranslationByCategory()
    {
        $order = factory(Order::class)->make();

        $combiAmount = 5;
        $combiFree = 2;
        $categoryId = 1;

        $discount = new DiscountByProductCategory($order);
        $discount->setCategoryId($categoryId);
        $discount->setCombiAmount($combiAmount);
        $discount->setCombiForFree($combiFree);

        $this->assertEquals($discount->identifier(),Types::BY_CATEGORY);

        $this->translationCompare($discount,[
            'categoryId'    =>  $categoryId,
            'combiAmount' =>  $this->spellOutNumber($combiAmount),
            'combiForFree' =>  $this->spellOutNumber($combiFree)
        ]);
    }

    public function testTranslationByCategoryCheapestProduct()
    {
        $order = factory(Order::class)->make();

        $minAmount = 2;
        $percentage = 20;
        $categoryId = 1;

        $discount = new DiscountCheapestProductByCategory($order);
        $discount->setCategoryId($categoryId);
        $discount->setPercentage($percentage);
        $discount->setMinAmount($minAmount);

        $this->assertEquals($discount->identifier(),Types::BY_CATEGORY_CHEAPEST_PRODUCT);

        $this->translationCompare($discount,[
            'categoryId'    =>  $categoryId,
            'min_amount' =>  $minAmount,
            'percentage' =>  $percentage
        ]);
    }

    private function translationCompare(DiscountInterface $discount,array $data){

        $translation = trans('discounts.' . $discount->identifier(),$data,config('apis.language'));

        $this->assertEquals($discount->message(),$translation);

    }
}
