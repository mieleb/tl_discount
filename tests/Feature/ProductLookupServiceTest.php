<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductLookupServiceTest extends TestCase
{

    public function testProductLookup()
    {
        $service = new ProductService();
        $productId = "A101";

        $productLookup = $service->findById($productId);

        $this->assertInstanceOf(Product::class,$productLookup);
    }

    public function testProductLookupFail()
    {
        $service = new ProductService();
        $productId = "AAA-A101";

        $productLookup = $service->findById($productId);

        $this->assertEquals(null,$productLookup);
    }
}
