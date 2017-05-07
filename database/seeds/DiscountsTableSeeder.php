<?php

use Illuminate\Database\Seeder;

class DiscountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->insert(
            [
                'discount'     => 10,
            ]
        );
        DB::table('discounts')->insert(
            [
                'discount'     => 15,
            ]
        );
        DB::table('discounts')->insert(
            [
                'discount'     => 20,
            ]
        );
        DB::table('discounts')->insert(
            [
                'discount'     => 25,
            ]
        );
    }
}
