<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 10:35
 */

namespace App\Services\Discount\Rules;

use App\Services\Discount\Types;
use Illuminate\Support\Collection;
use App\Models\OrderItem;

use App\Fields\OrderItem as OrderItemFields;

class DiscountCheapestProductByCategory extends BaseDiscountByCategory implements DiscountInterface
{
    private $minAmount = 2;
    private $percentage = 20;

    public function identifier(): string
    {
        return Types::BY_CATEGORY_CHEAPEST_PRODUCT;
    }

    public function setMinAmount(int $amount){

        $this->minAmount = $amount;
    }

    public function getMinAmount() : int {

        return $this->minAmount;
    }

    public function setPercentage(int $percentage){

        $this->percentage = $percentage;
    }

    public function getPercentage() : int {

        return $this->percentage;
    }

    public function getCheapesProduct(Collection $items) : OrderItem {

        return $items
            ->sortBy(OrderItemFields::UNIT_PRICE)
            ->first();
    }

    public function calculate($orderItemTotal) : float {

        return $orderItemTotal * ($this->getPercentage() / 100);
    }

    public function amount(): float
    {
        $orderItemsByCategory = $this->itemsInCategory();
        $amount = 0;

        if($orderItemsByCategory->count() >= $this->getMinAmount()){

            /* @var \App\Models\OrderItem $cheapestProduct */
            $cheapestProduct = $this->getCheapesProduct($orderItemsByCategory);
            $amount += $this->calculate($cheapestProduct->{OrderItemFields::TOTAL});
        }

        return $amount;

    }

    public function message(): string
    {
        return $this->translation([
            'categoryId'   => $this->getCategoryId(),
            'min_amount'    =>  $this->getMinAmount(),
            'percentage'    =>  $this->getPercentage(),
        ]);
    }

}
