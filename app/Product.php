<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id', 'artnr' ,'name','kind', 'stock'];

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

    public function ProductReservation(){
        return $this->hasOne('App\ProductReservation');
    }
}
