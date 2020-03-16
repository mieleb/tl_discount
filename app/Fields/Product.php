<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 09:47
 */

namespace App\Fields;

use MyCLabs\Enum\Enum;

class Product extends Enum
{


    const ID = 'id';
    const DESCRIPTION = 'description';
    const CATEGORY = 'category';
    const PRICE = 'price';

}
