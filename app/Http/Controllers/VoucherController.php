<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Voucher;
use App\Discount;

class VoucherController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'discount' => 'required|exists:discounts,discount',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);
        $discountObject = Discount::where('discount', $request->get('discount'))->first();

        $voucherData = array_merge(['discount_id' => $discountObject->id], $request->only(['start_date','end_date']));
        $voucher = Voucher::create($voucherData);

        return response()->json($voucher->toArray());
    }
}
