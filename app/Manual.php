<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manual extends Model
{
    // mass assignment 
    protected $guarded = [];

    public function products(){
        return $this->belongsTo('App\Product');
    }

    public function feedMessage(){
        return $this->morphMany('App\FeedMessage', 'reference');
    }
}
