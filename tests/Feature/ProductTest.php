<?php

namespace Tests\Feature;

use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    public function testStore()
    {
        $response = $this->json('POST', '/api/product', ['name' => 'test product #3', 'price' => 300]);

        $response->assertJson([
            'name' => 'test product #3',
            'price' => 300,
                                  ]);
    }

    public function testBind()
    {
        $response = $this->json('PUT', '/api/product/1/1');

        $response->assertJson([
              'name' => 'test product #1',
              'price' => 90,
          ]);
    }

    public function testUnBind()
    {
        $this->json('PUT', '/api/product/1/1');
        $response = $this->json('DELETE', '/api/product/1/1');

        $response->assertJson([
              'name' => 'test product #1',
              'price' => 100,
          ]);
    }

    public function testBuy()
    {
        $this->json('PUT', '/api/product/1/1');
        $response = $this->json('POST', '/api/product/1/buy');

        $response->assertSeeText('ok');
    }

    public function testIndex()
    {
        $response = $this->json('get', '/api/products/name/asc');

        $products = Product::getProducts('name', 'asc')->toArray();
        $response->assertViewHas('products', $products);
    }
}
