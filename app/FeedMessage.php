<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedMessage extends Model
{
    protected $guarded = [];

    public function reference(){
        return $this->morphTo();
    }
}
