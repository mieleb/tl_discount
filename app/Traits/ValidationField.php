<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 09:56
 */

namespace App\Traits;

trait ValidationField
{

    public static function subArrayField(string $arrayField,string $subArrayField) : string {

        return $arrayField . '.*.' . $subArrayField;
    }

}
