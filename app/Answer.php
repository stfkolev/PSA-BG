<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Discussion;
use App\User;

class Answer extends Model
{

     /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * An answer has a discussion.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function discussion() {
       return $this->belongsTo('App\Discussion');
    }

    /**
     * An answer has an owner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
