<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 09:49
 */

namespace App\Fields;


use MyCLabs\Enum\Enum;

class OrderItem extends Enum
{

    /*
     * "product-id": "B102",
      "quantity": "10",
      "unit-price": "4.99",
      "total": "49.90"
     */

    const PRODUCT_ID = 'product-id';
    const QUANTITY = 'quantity';
    const UNIT_PRICE = 'unit-price';
    const TOTAL = 'total';
}
