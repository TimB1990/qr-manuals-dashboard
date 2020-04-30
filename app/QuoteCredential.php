<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuoteCredential extends Model
{
    protected $guarded = [];
    
    public function customer(){
        return $this->belongsTo('App\Customer'); 
    }

    public function quote(){
        return $this->hasOne('App\Quote');
    }
}
