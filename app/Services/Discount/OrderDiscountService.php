<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 10:52
 */


namespace App\Services\Discount;

use App\Models\Order;

class OrderDiscountService
{
    private $ruleCollection;
    private $activeDiscounts = [];

    public function __construct(OrderRuleCollection $ruleCollection)
    {
        $this->ruleCollection = $ruleCollection;
    }

    public function apply() {

        /* @var \App\Services\Discount\Rules\DiscountInterface $discountRule */
        foreach ($this->ruleCollection->getRules() as $discountRule){

            if($discountRule->amount() > 0){

                $this->activeDiscounts[] = $discountRule;
            }
        }

        return $this;
    }

    public function getActiveDiscounts() : array {

        return $this->activeDiscounts;
    }

}
