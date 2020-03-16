<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Fields\OrderItem as OrderItemFields;

$factory->define(\App\Models\OrderItem::class, function (Faker $faker) {

    $quantity = $faker->numberBetween(1,20);
    $unitPrice = $faker->randomFloat(null,1,99);

    return [
        OrderItemFields::PRODUCT_ID =>  $faker->word,
        OrderItemFields::UNIT_PRICE =>  $unitPrice,
        OrderItemFields::QUANTITY   =>  $quantity,
        OrderItemFields::TOTAL  =>  $quantity * $unitPrice
    ];
});
