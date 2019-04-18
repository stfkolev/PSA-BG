<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

use Overtrue\LaravelLike\Traits\CanLike;

use Cog\Contracts\Ban\Bannable as BannableContract;
use Cog\Laravel\Ban\Traits\Bannable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable implements BannableContract
{
    use LaratrustUserTrait;
    
    use CanLike, Bannable, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*! Many Posts */
    public function posts() {
        return $this->hasMany('App\Post');
    }

    /*! Many Requests */
    public function requests() {
        return $this->hasMany('App\Requests');
    }

    /*! Many Shots */
    public function shots() {
        return $this->hasMany('App\Shot');
    }

    public function replies() {
        return $this->hasMany('App\Reply');
    }

    public function answers() {
        return $this->hasMany('App\Answer');
    }

    public function discussions() {
        return $this->hasMany('App\Discussion');
    }
}
