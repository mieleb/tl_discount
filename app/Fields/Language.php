<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 16/03/20
 * Time: 06:39
 */

namespace App\Fields;


use MyCLabs\Enum\Enum;

class Language extends Enum
{
    const QUERY_PARAM = 'language';

    const NL = 'nl';
    const FR = 'fr';

    public static function allowed() : array {

        return [

            self::NL,
            self::FR,
        ];
    }
}
