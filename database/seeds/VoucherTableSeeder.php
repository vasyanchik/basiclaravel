<?php

use Illuminate\Database\Seeder;

class VoucherTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vouchers')->insert(
            [
                'discount_id'     => 1,
                'start_date'     => '2017-01-01',
                'end_date'     => '2017-12-31',
            ]
        );
        DB::table('vouchers')->insert(
            [
                'discount_id'     => 2,
                'start_date'     => '2017-01-01',
                'end_date'     => '2017-12-31',
            ]
        );
        DB::table('vouchers')->insert(
            [
                'discount_id'     => 3,
                'start_date'     => '2017-01-01',
                'end_date'     => '2017-12-31',
            ]
        );
        DB::table('vouchers')->insert(
            [
                'discount_id'     => 4,
                'start_date'     => '2017-01-01',
                'end_date'     => '2017-12-31',
            ]
        );
    }
}
