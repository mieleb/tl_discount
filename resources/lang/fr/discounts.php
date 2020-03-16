<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 16/03/20
 * Time: 07:24
 */

return [
    \App\Services\Discount\Types::TOTAL_PRICE   =>  'Vous avez commandé pour plus de € :price_limit, vous bénéficierez d\'une remise de :percentage % sur l\'ensemble de votre commande',
    \App\Services\Discount\Types::BY_CATEGORY_CHEAPEST_PRODUCT  =>  'Vous avez acheté :min_amount ou plus de produits de la catégorie "Outils" (id :categoryId), vous obtenez :percentage % de remise sur votre produit le moins cher.',
    \App\Services\Discount\Types::BY_CATEGORY   =>  'Pour chaque produit de la catégorie "Commutateurs" (id :categoryId), lorsque vous achetez ":combiAmount", vous obtenez ":combiForFree" gratuitement.'
];
