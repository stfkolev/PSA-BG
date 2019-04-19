<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\User;

use Overtrue\LaravelLike\Traits\CanBeLiked;

class Shot extends Model
{
    use CanBeLiked, RecordsActivity;

    public function user() {
        return $this->belongsTo('App\User');
    }
}
