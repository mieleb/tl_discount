<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 10:28
 */

namespace App\Services\Discount\Rules;

use App\Models\Order;

interface DiscountInterface {

    public function __construct(Order $order);

    public function identifier() : string;

    public function amount() : float;

    public function message() : string;
}
