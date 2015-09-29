<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Category extends Auditing
{
    protected $guarded = ['id'];

    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
