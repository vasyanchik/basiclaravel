<?php

namespace App\Http\Controllers;

use App\Voucher;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'price' => 'required|numeric',
            'name' => 'required|string|max:255',
        ]);

        $product = Product::create($request->only('price', 'name'));
        return response()->json($product->toArray());
    }

    public function bind(Product $product, Voucher $voucher)
    {
        $product->vouchers()->attach($voucher->id);
        return response()->json($product->toArray());
    }

    public function unbind(Product $product, Voucher $voucher)
    {
        $product->vouchers()->detach($voucher->id);
        return response()->json($product->toArray());
    }

    public function buy(Product $product)
    {
        $product->buy();
        return response()->json('ok');
    }

    public function index($sortBy, $order)
    {
        return view('products', ['products' => Product::getProducts($sortBy, $order)->toArray()]);
    }
}
