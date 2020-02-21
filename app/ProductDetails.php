<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    // set custom primary key
    protected $primaryKey = "product_id";

    // set incrementing to false
    public $incrementing = false;

    // set keytype of model to be a string
    protected $keyType = 'string';

    public function products(){
        return $this->belongsTo('App\Product');
    }
}
