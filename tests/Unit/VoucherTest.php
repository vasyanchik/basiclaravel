<?php

namespace Tests\Unit;

use App\Product;
use App\Voucher;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VoucherTest extends TestCase
{
    public function testIsActive()
    {
        $voucher = Voucher::find(1);
        $this->assertEquals(true, $voucher->isActive());
    }

    public function testIsActiveUnavailable()
    {
        $voucher = Voucher::find(1);
        $voucher->available = 0;
        $voucher->save();
        $this->assertEquals(false, $voucher->isActive());
    }

    public function testIsActiveOutOfDate()
    {
        $voucher = Voucher::find(1);
        $voucher->start_date = '2017-12-11';
        $voucher->save();
        $this->assertEquals(false, $voucher->isActive());
    }


}
