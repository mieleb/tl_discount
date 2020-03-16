<?php

namespace App\Presenters;

use Illuminate\Http\Request;

abstract class Presenter
{
    protected $entity;
    protected $key;
    protected $request;

    public function __construct($entity,$key)
    {
        $this->entity = $entity;
        $this->key = $key;
        $this->request = app()->make(Request::class);
    }

    public function __get($property)
    {
        if (method_exists($this, $property))
        {
            return $this->{$property}();
        }

        return $this->entity->{$property};
    }

    public function __isset($property)
    {
        return isset($this->entity->{$property}) || method_exists($this, $property);
    }
}
