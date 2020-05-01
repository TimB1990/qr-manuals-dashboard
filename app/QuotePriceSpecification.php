<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuotePriceSpecification extends Model
{
    protected $guarded = [];
    
    public function quote(){
        return $this->belongsTo('App\Quote');
    }
}

