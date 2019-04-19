<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    use RecordsActivity;
    
    protected $primaryKey = "id";
    
    /*! One Request may have many posts */
    public function posts() {
        return $this->hasMany('App\Post');
    }
    
    public function replies() {
        return $this->hasMany('App\Reply');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }

}
