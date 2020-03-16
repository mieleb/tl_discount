<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BaseCollection extends ResourceCollection
{
    private $wrapperKey = 'data';

    public function getWrapperKey(){

        return $this->wrapperKey;
    }

    public function setWrapperKey($value){

        $this->wrapperKey = $value;
    }

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */

    public function toArray($request)
    {
        return [
            $this->getWrapperKey() => $this->collection,
        ];
    }
}
