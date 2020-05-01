<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];
    
    public function quote(){
        return $this->hasMany('App\Quote');
    }

    public function quoteCredential(){
        return $this->hasMany('App\QuoteCredential');
    }
}
