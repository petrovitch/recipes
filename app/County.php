<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;
use Kyslik\ColumnSortable\Sortable;

class County extends Auditing
{
    use Sortable;

    protected $table = 'counties';
    protected $guarded = ['id'];

    public function state()
    {
        return $this->belongsTo('App\State', 'state_id');
    }

    public function farm()
    {
        return $this->belongsToMany('App\County', 'county_id');
    }
}
