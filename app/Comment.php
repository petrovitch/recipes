<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Comment extends Auditing
{
    protected $guarded = ['id'];

    public function post()
    {
        return $this->morphTo();
    }
}
