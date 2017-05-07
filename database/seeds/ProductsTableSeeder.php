<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
            [
                'name'     => 'Intel Core I3 processor',
                'price'     => 100,
            ]
        );
        DB::table('products')->insert(
            [
                'name'     => 'Intel Core I5 processor',
                'price'     => 200,
            ]
        );
        DB::table('products')->insert(
            [
                'name'     => 'Intel Core I7 processor',
                'price'     => 300,
            ]
        );

        DB::table('product_voucher')->insert(
            [
                'product_id'     => 1,
                'voucher_id'     => 4,
            ]
        );
        DB::table('product_voucher')->insert(
            [
                'product_id'     => 1,
                'voucher_id'     => 3,
            ]
        );
        DB::table('product_voucher')->insert(
            [
                'product_id'     => 2,
                'voucher_id'     => 1,
            ]
        );
        DB::table('product_voucher')->insert(
            [
                'product_id'     => 2,
                'voucher_id'     => 3,
            ]
        );

    }
}
