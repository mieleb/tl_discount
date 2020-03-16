<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Fields\Order as OrderFields;

$factory->define(\App\Models\Order::class, function (Faker $faker) {
    return [
        OrderFields::ID =>  $faker->randomNumber(),
        OrderFields::CUSTOMER_ID    =>  $faker->randomNumber(),
        OrderFields::ITEMS => function () use($faker) {
            return factory(\App\Models\OrderItem::class,$faker->numberBetween(1,5))->make();
        },
        OrderFields::TOTAL  =>  $faker->randomNumber()
    ];
});
