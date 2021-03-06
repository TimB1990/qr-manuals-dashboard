<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function manuals(){
        return $this->hasMany('App\Manual');
    }

    public function productDetails(){
        return $this->hasOne('App\ProductDetails');
    }

    public function quotes(){
        return $this->hasMany('App\Quote');
    }

    public function productReservation(){
        return $this->hasOne('App\ProductReservation');
    }

    public function qrSheets(){
        return $this->belongsToMany('App\QrSheet');
    }
}
