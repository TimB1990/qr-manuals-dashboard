<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $guarded = [];

    public function product(){
        return $this->belongsTo('App\Product');
    }

    public function productReservation(){
        return $this->belongsTo('App\ProductReservation');
    }

}

