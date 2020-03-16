<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Fields\Product as ProductFields;

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    return [
        ProductFields::ID   =>  $faker->word,
        ProductFields::CATEGORY =>  $faker->numberBetween(1,2),
        ProductFields::DESCRIPTION  =>  $faker->word,
        ProductFields::PRICE    =>  $faker->randomFloat(),
    ];
});
