<?php
/**
 * Created by PhpStorm.
 * User: michielbogaert
 * Date: 15/03/20
 * Time: 12:39
 */

namespace App\Services\Product;

use App\Models\Product;
use Illuminate\Support\Collection;
use App\Fields\Product as ProductFields;

class ProductService
{
    private $data;

    public function __construct()
    {
        $this->setData();
    }

    public function findById($productId){

        $product = $this->getData()
            ->where(ProductFields::ID,'=',$productId)
            ->first();

        if($product){

            $model = new Product();
            return $model->fill($product);
        }

        return null;
    }

    /**
     * @return Collection
     */
    public function getData()
    {
        return $this->data;
    }

    private function setData() {

        $data = '[
                      {
                        "id": "A101",
                        "description": "Screwdriver",
                        "category": "1",
                        "price": "9.75"
                      },
                      {
                        "id": "A102",
                        "description": "Electric screwdriver",
                        "category": "1",
                        "price": "49.50"
                      },
                      {
                        "id": "B101",
                        "description": "Basic on-off switch",
                        "category": "2",
                        "price": "4.99"
                      },
                      {
                        "id": "B102",
                        "description": "Press button",
                        "category": "2",
                        "price": "4.99"
                      },
                      {
                        "id": "B103",
                        "description": "Switch with motion detector",
                        "category": "2",
                        "price": "12.95"
                      }
                    ]';

        $this->data = collect(json_decode($data,true));
    }

}
