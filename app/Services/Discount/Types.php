<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 16/03/20
 * Time: 07:28
 */

namespace App\Services\Discount;

use MyCLabs\Enum\Enum;

class Types extends Enum
{
    const TOTAL_PRICE = 'total_price';
    const BY_CATEGORY = 'by_category';
    const BY_CATEGORY_CHEAPEST_PRODUCT = 'by_category_cheapest_product';
}
