<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 16/03/20
 * Time: 07:50
 */

namespace App\Traits;

trait NumberSpeller {

    protected function spellOutNumber($number){

        $numberFormatter = new \NumberFormatter(config('apis.language'),\NumberFormatter::SPELLOUT);
        return $numberFormatter->format($number);
    }
}
