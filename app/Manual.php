<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    // mass assignment 
    protected $guarded = [];
    // set custom primary key
    protected $primaryKey = "file_name";
    // set keytype of model to be a string
    protected $keyType = 'string';

    // set incrementing to false
    public $incrementing = false;

    public function products(){
        return $this->belongsTo('App\Product');
    }
}
