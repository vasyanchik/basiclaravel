<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Voucher extends Model
{
    protected $dates = [
        'start_date',
        'end_date',
    ];

    protected $fillable = [
        'start_date',
        'end_date',
        'discount_id',
        'available',
    ];

    public function discount()
    {
        return $this->belongsTo('App\Discount');
    }

    public function isActive()
    {
        if (!$this->available) {
            return false;
        }
        if ($this->start_date->isFuture() || $this->end_date->isPast()) {
            return false;
        }
        return true;
    }
}
