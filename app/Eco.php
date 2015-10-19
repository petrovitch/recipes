<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;
use Kyslik\ColumnSortable\Sortable;

class Eco extends Auditing
{
    use Sortable;

    protected $table = 'mcc_ecos';
    protected $guarded = ['id'];

    public function games()
    {
        return $this->hasMany('App\Game', 'eco', 'eco');
    }
}
