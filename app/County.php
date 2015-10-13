<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class County extends Auditing
{
    protected $table = 'counties';

    protected $fillable = ['state_id', 'county', 'label', 'locale'];

    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');
    }
}
