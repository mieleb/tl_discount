<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 09:46
 */

namespace App\Fields;

use MyCLabs\Enum\Enum;

class Order extends Enum
{

    const ID = 'id';
    const CUSTOMER_ID = 'customer-id';

    const ITEMS = 'items';
    const TOTAL = 'total';

}
