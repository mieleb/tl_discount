<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 14:08
 */

namespace App\Presenters;


class DiscountPresenter extends Presenter
{

    public function amount(){

        return $this->entity->amount();
    }

    public function message(){

        return $this->entity->message();
    }

}
