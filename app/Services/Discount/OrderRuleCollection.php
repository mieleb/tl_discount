<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 10:30
 */

namespace App\Services\Discount;

use App\Models\Order;
use App\Services\Discount\Rules\DiscountInterface;

use App\Services\Discount\Rules\DiscountByProductCategory;
use App\Services\Discount\Rules\DiscountCheapestProductByCategory;
use App\Services\Discount\Rules\DiscountPercentageByTotalPrice;

class OrderRuleCollection
{
    private $rules = [];
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->baseRules();
    }

    public function addRule(DiscountInterface $discountClass){

        $this->rules[] = $discountClass;

        return $this;
    }

    public function getRules(){

        return $this->rules;
    }

    private function baseRules(){

        $this->percentageByTotalPrice();
        $this->cheapestProductByCategory();
        $this->productCategory();
    }

    private function percentageByTotalPrice()
    {
        $ruleByPrice = new DiscountPercentageByTotalPrice($this->order);
        $ruleByPrice->setPercentage(10);

        $this->addRule($ruleByPrice);
    }

    private function productCategory(){

        $ruleByCategory = new DiscountByProductCategory($this->order);
        $ruleByCategory->setCategoryId(2);

        $this->addRule($ruleByCategory);
    }

    private function cheapestProductByCategory(){

        $ruleByCheapestProduct = new DiscountCheapestProductByCategory($this->order);
        $ruleByCheapestProduct->setCategoryId(1);

        $this->addRule($ruleByCheapestProduct);
    }

}
