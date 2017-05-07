<?php

namespace Tests\Unit;

use App\Product;
use App\Voucher;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductTest extends TestCase
{
    public function testPriceWithoutDiscount()
    {
        $product = Product::find(1);
        $this->assertEquals(100, $product->price);
    }

    public function testPriceWithDiscount()
    {
        $product = Product::find(1);

        $product->vouchers()->attach(1); // 1 - 10% discount
        $product->vouchers()->attach(2); // 2 - 15% discount

        $this->assertEquals(75.00, $product->price);
    }

    public function testPriceWithDiscountMore60()
    {
        $product = Product::find(1);

        $product->vouchers()->attach(1); // 1 - 10% discount
        $product->vouchers()->attach(2); // 2 - 15% discount
        $product->vouchers()->attach(3); // 3 - 20% discount
        $product->vouchers()->attach(4); // 2 - 25% discount

        $this->assertEquals(40.00, $product->price);
    }

    public function testPriceWithDiscountNotAvailable()
    {
        $product = Product::find(1);

        $product->vouchers()->attach(1); // 1 - 10% discount
        $voucher = Voucher::find(1);
        $voucher->available = 0;
        $voucher->save();

        $this->assertEquals(100.00, $product->price);
    }

    public function testPriceWithDiscountOutOfDate()
    {
        $product = Product::find(1);

        $product->vouchers()->attach(1); // 1 - 10% discount
        $voucher = Voucher::find(1);
        $voucher->end_date = '2017-01-02';
        $voucher->save();

        $this->assertEquals(100.00, $product->price);
    }

    public function testGetProductsAsc()
    {
        $products = Product::getProducts('name', 'asc');
        $this->assertEquals('test product #1', $products[0]->name);
        $this->assertEquals('test product #2', $products[1]->name);
    }

    public function testGetProductsDesc()
    {
        $products = Product::getProducts('name', 'desc');
        $this->assertEquals('test product #2', $products[0]->name);
        $this->assertEquals('test product #1', $products[1]->name);
    }

    public function testGetProductsNotAvailable()
    {
        $product = Product::find(1);
        $product->available = 0;
        $product->save();

        $products = Product::getProducts('name', 'asc');
        $this->assertEquals(1, count($products));
    }

    public function testBuy()
    {
        $product = Product::find(1);
        $product->vouchers()->attach(1); // 1 - 10% discount

        $product->buy();
        $this->assertEquals(false, $product->available);

        $voucher = Voucher::find(1);
        $this->assertEquals(false, $voucher->available);
    }

}
