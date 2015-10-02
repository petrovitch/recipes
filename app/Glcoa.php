<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Glcoa extends Auditing
{
    protected $table = 'glcoas';

    protected $fillable = ['acct', 'title', 'init'];

    public function gltrns()
    {
        return $this->hasMany('App\Gltrn', 'acct', 'acct')->withTimestamps();
    }

}
