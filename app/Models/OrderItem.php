<?php

namespace App\Models;

use App\Services\Product\ProductService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\Fields\OrderItem as OrderItemFields;

class OrderItem extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        OrderItemFields::PRODUCT_ID,
        OrderItemFields::UNIT_PRICE,
        OrderItemFields::QUANTITY,
        OrderItemFields::TOTAL
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];


    public function getProductAttribute() {

        $service =  new ProductService();
        return  $service->findById($this->{OrderItemFields::PRODUCT_ID});
    }

}
