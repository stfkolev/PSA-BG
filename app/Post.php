<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $primaryKey = "id";
    
    /*! Get the request that owns the post */
    public function request() {
        return $this->belongsTo('App\Requests');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
