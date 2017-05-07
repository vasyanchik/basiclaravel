<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
        if($sortBy == 'name'){
            return self::orderBy('name', $order)->available()->get();
        }else{
            return self::orderBy('name', $order)->available()->get();
        }
    }
}
