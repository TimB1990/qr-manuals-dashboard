<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['id','productname','kind','category_id'];
    // set incrementing to false
    public $incrementing = false;

    // set keytype of model to be a string
    protected $keyType = 'string';

    public function categories(){
        return $this->belongsToMany('App\Category');
    }

    /*public function manuals(){
        return $this->hasMany('App\Manual');
    }*/

    /*public function productDetails(){
        return $this->hasOne('App\ProductDetails');
    }*/
}
