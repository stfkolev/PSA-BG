<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Category;
use App\Answer;
use App\User;

class Discussion extends Model
{

    /**
     * Don't auto-apply mass assignment protection.
     *
     * @var array
     */
    protected $guarded = [];

     /**
     * Get a string path for the discussion.
     *
     * @return string
     */
    public function path() {
        return '/discussions/'. $this->category->id . '/' . $this->id;
    }

    public function answers() {
        return $this->hasMany('App\Answer');
    }

      /**
     * A discussion belongs to an user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Add an answer to the discussion.
     *
     * @param $answer
     */
    public function addAnswer($answer)
    {
        $this->answers()->create($answer);
    }

    /**
     * A discussion belongs to a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category() {
        return $this->belongsTo('App\Category');
    }
}
