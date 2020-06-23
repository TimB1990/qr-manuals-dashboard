<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QrSheet extends Model
{
    // use SoftDeletes;
    protected $guarded = [];

    public function products(){
        return $this->belongsToMany('App\Product');
    }

        public function feedMessages(){
        return $this->morphMany('App\FeedMessage', 'reference');
    }
}
