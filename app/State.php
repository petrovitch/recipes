<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;
use Kyslik\ColumnSortable\Sortable;

class State extends Auditing
{
    use Sortable;

    protected $table = 'states';
    protected $fillable = ['state_abr', 'state'];

    public function county()
    {
        return $this->hasMany('App\County');
    }
}
