<?php

namespace Tests\Feature;

use App\Fields\OrderItem as OrderItemFields;
use App\Models\OrderItem as OrderItemModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderItemTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testOrderItemStructure()
    {
        $orderItemData = factory(OrderItemModel::class)->make();

        $model = new OrderItemModel();
        $record = $model->fill($orderItemData->toArray());

        $this->assertEquals($orderItemData->{OrderItemFields::PRODUCT_ID},$record->{OrderItemFields::PRODUCT_ID});
        $this->assertEquals($orderItemData->{OrderItemFields::TOTAL},$record->{OrderItemFields::TOTAL});
        $this->assertEquals($orderItemData->{OrderItemFields::QUANTITY},$record->{OrderItemFields::QUANTITY});
        $this->assertEquals($orderItemData->{OrderItemFields::UNIT_PRICE},$record->{OrderItemFields::UNIT_PRICE});
    }
}
