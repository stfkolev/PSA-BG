<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Discussion;

class Category extends Model
{
    /**
     * Get a string path for the category.
     *
     * @return string
     */
    public function path() {
        return '/discussions/categories/'. $this->title;
    }

    /**
     * A category has many discussions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function discussions() {
        return $this->hasMany('App\Discussion');
    }
}
