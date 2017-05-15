<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    const MAX_DISCOUNT = 60;

    protected $fillable = [
        'price',
        'name',
    ];

    public function vouchers()
    {
        return $this->belongsToMany('App\Voucher');
    }

    public function getPriceAttribute($price)
    {
        $discounts = 0;
        foreach($this->vouchers as $voucher){
            if($voucher->isActive()){
                $discounts += $voucher->discount->discount;
            }
        }
        $discounts = min(self::MAX_DISCOUNT, $discounts);

        $price = $price - ($price * ($discounts / 100));

        return $price;
    }

    public function scopeAvailable(Builder $query)
    {
        return $query->where('available', 1);
    }

    public function buy()
    {
        $this->available = 0;
        $this->save();

        foreach ($this->vouchers as $voucher) {
            $voucher->available = 0;
            $voucher->save();
        }
    }

    static public function getProducts($sortBy, $order)
    {
        switch($sortBy){
            case 'price':
                return self::getProductsByPrice($order);
            default:
                return self::orderBy($sortBy, $order)->available()->get()->toArray();
        }
    }

    static public function getProductsByPrice($order)
    {
        $rawResults = DB::table('products')
                        ->select(DB::raw('products.*, products.price - (products.price * (least('.self::MAX_DISCOUNT.', ifnull((select sum(d.discount) from vouchers v, discounts d, product_voucher pv where pv.product_id=products.id and pv.voucher_id=v.id and d.id=v.discount_id and v.available=1 and v.start_date<=now() and v.end_date>=now()), 0)) / 100)) price'))
                        ->where('available', 1)
                        ->orderBy('price', $order)
                        ->get();
        $results = [];
        foreach($rawResults as $item){
            $results[] = (array)$item;
        }
        return $results;
    }
}
