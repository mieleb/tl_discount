<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 11:12
 */

namespace App\Services\Discount\Rules;

use App\Models\Order;

class BaseDiscount
{
    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function translation($params): string
    {
        return trans('discounts.' . $this->identifier(),$params,config('apis.language'));
    }

}
