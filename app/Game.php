<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;
use Kyslik\ColumnSortable\Sortable;

class Game extends Auditing
{
    use Sortable;

    protected $table = 'mcc_games';
    protected $guarded = ['id'];

    public function ecos()
    {
        return $this->belongsTo('App\Eco', 'eco', 'eco');
    }
}
