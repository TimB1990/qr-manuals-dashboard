<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductReservation extends Model
{
    protected $guarded = [];

    public function Product(){
        return $this->belongsTo('App\Product');
    }

    public function Quotes(){
        return $this->hasMany(`App\Quote`);
    }
}
