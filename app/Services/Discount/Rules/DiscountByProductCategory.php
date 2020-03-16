<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 10:34
 */

namespace App\Services\Discount\Rules;

use App\Models\OrderItem;
use App\Services\Discount\Types;
use App\Traits\NumberSpeller;

class DiscountByProductCategory extends BaseDiscountByCategory implements DiscountInterface
{
    use NumberSpeller;

    public $combiAmount = 5;
    public $combiForFree = 1;


    public function getCombiForFree(): int
    {
        return $this->combiForFree;
    }

    public function setCombiForFree(int $combiForFree): void
    {
        $this->combiForFree = $combiForFree;
    }

    public function identifier(): string
    {
        return Types::BY_CATEGORY;
    }

    public function getCombiAmount(): int
    {
        return $this->combiAmount;
    }

    public function setCombiAmount(int $combiAmount): void
    {
        $this->combiAmount = $combiAmount;
    }


    public function calculate(OrderItem $orderItem) : float {

        $numberProductsFree = (int)$orderItem->{\App\Fields\OrderItem::QUANTITY} / ($this->getCombiAmount() + $this->getCombiForFree());
        $numberFloored = floor($numberProductsFree);

        return $numberFloored * $orderItem->{\App\Fields\OrderItem::UNIT_PRICE};
    }

    public function amount(): float
    {
        $itemsInCategory = $this->itemsInCategory();
        $amount = 0;

        $itemsInCategory->each(function(OrderItem $orderItem) use(&$amount){

            $amount += $this->calculate($orderItem);
        });

        return $amount;
    }

    public function message(): string
    {
        return $this->translation([
            'categoryId'    =>  $this->getCategoryId(),
            'combiAmount'   =>  $this->spellOutNumber($this->getCombiAmount()),
            'combiForFree'  =>  $this->spellOUtNumber($this->getCombiForFree())
        ]);
    }

}
