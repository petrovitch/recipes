<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class State extends Auditing
{
    protected $table = 'states';

    protected $fillable = ['state_abr', 'state'];

    public function county()
    {
        return $this->hasMany('App\County');
    }
}
