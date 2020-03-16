<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 10:32
 */

namespace App\Services\Discount\Rules;

use App\Services\Discount\Types;

class DiscountPercentageByTotalPrice extends BaseDiscount implements DiscountInterface
{
    private $percentage = 10;
    private $priceLimit = 1000;

    public function getPriceLimit(): int
    {
        return $this->priceLimit;
    }

    public function setPriceLimit(int $priceLimit): void
    {
        $this->priceLimit = $priceLimit;
    }

    public function setPercentage(int $percentage){

        $this->percentage = $percentage;
    }

    public function identifier(): string
    {
        return Types::TOTAL_PRICE;
    }

    protected function getPercentage() : int {

        return $this->percentage;
    }

    public function isActive(): bool
    {
        $totalOrderPrice = $this->order->total;

        if($totalOrderPrice > $this->getPriceLimit()){

            return true;
        }

        return false;
    }

    public function amount() : float
    {
        $amount = 0;

        if($this->isActive()){

            $totalOrderPrice = $this->order->total;
            $amount = $totalOrderPrice * ($this->getPercentage() / 100);
        }

        return $amount;
    }

    public function message(): string
    {
        return $this->translation([
            'price_limit'   => $this->getPriceLimit(),
            'percentage'    =>  $this->getPercentage()
        ]);
    }

}
