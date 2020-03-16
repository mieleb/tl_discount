<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 16/03/20
 * Time: 07:24
 */

return [
    \App\Services\Discount\Types::TOTAL_PRICE   =>  'Je hebt voor meer dan € :price_limit besteld, je krijgt een korting van  :percentage % op je volledige order',
    \App\Services\Discount\Types::BY_CATEGORY_CHEAPEST_PRODUCT  =>  'Je hebt :min_amount of meer producten van de category "Tools" gekocht (id :categoryId), je krijgt :percentage % korting op je goedkoopste product.',
    \App\Services\Discount\Types::BY_CATEGORY   =>  'Voor elk product van de category "Switches" (id :categoryId), wanneer je er ":combiAmount" koopt, krijg je er ":combiForFree" gratis.'
];
