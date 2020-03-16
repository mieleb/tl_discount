<?php

namespace App\Http\Resources;

class Discounts extends BaseCollection
{
    public $collects = DiscountItem::class;

    public function toArray($request)
    {
        $this->setWrapperKey('discounts');
        return parent::toArray($request);
    }
}

