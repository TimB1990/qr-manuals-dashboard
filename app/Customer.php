<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];
    
    public function quotes(){
        return $this->hasMany('App\Quote');
    }

    public function quoteCredentials(){
        return $this->hasMany('App\QuoteCredential');
    }
}
