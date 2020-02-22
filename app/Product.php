<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [];
    // set incrementing to false
    public $incrementing = false;

    // set keytype of model to be a string
    protected $keyType = 'string';

    // mass assignment
    // protected $fillable = ['name'];

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
