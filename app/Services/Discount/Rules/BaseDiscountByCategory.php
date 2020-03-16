<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 11:12
 */

namespace App\Services\Discount\Rules;

use Illuminate\Support\Collection;
use App\Models\OrderItem;

class BaseDiscountByCategory extends BaseDiscount
{
    public $categoryId; //Switches

    public function setCategoryId(int $categoryId){

        $this->categoryId = $categoryId;
    }

    public function getCategoryId() : int {

        return $this->categoryId;
    }

    protected function itemsInCategory() : Collection {

        /* @var \Illuminate\Support\Collection $orderItems */
        $orderItems = $this->order->items;

        return $orderItems->filter(function(OrderItem $orderItem){

            return (int)optional($orderItem->product)->category === $this->getCategoryId();
        });
    }
}
