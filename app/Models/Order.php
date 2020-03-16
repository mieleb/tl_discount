<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use App\Fields\Order as OrderFields;
use Illuminate\Support\Collection;

class Order extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        OrderFields::ID,
        OrderFields::CUSTOMER_ID,
        OrderFields::ITEMS,
        OrderFields::TOTAL,
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

    public function setItemsAttribute($orderItems){

        //fill from array
        //default
        if(!$orderItems instanceof Collection) {

            $items = new Collection();

            foreach ($orderItems as $orderItem) {

                $items->add((new OrderItem())->fill($orderItem));
            }
        }

        //fill from factory
        if($orderItems instanceof Collection){
            $items = $orderItems;
        }

        $this->relations['items'] = $items;
    }

}
