<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// product that is on quote
class QuoteProduct extends Model
{
    protected $guarded = [];

    public function quote(){
        return $this->belongsToMany('App\Quote');
    }

}
