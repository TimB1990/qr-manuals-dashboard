<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id', 'artnr' ,'name','kind'];
    // set incrementing to false

    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    public function manuals(){
        return $this->hasMany('App\Manual');
    }

    public function productDetails(){
        return $this->hasOne('App\ProductDetails');
    }
}
