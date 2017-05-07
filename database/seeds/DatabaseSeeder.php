<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DiscountsTableSeeder::class);
        $this->call(VoucherTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
    }
}
