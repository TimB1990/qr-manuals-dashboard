<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $guarded = [];

    public function customer(){
        return $this->belongsTo('App\Customer');
    }

    public function quoteProducts(){
        return $this->hasMany('App\QuoteProduct');
    }

    public function quotePriceSpecification(){
        return $this->hasOne('App\QuotePriceSpecification');
    }

    public function quoteCredential(){
        return $this->belongsTo('App\QuoteCredential');
    }

        public function feedMessage(){
        return $this->morphMany('App\FeedMessage', 'reference');
    }
}

