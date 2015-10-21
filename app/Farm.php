<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;
use Kyslik\ColumnSortable\Sortable;

class Farm extends Auditing
{
    use Sortable;

    protected $table = 'farms';
    protected $guarded = ['id'];

    public function county()
    {
        return $this->hasMany('App\County', 'id');
    }
}
