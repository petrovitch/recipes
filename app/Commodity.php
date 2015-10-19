<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;
use Kyslik\ColumnSortable\Sortable;

class Commodity extends Auditing
{
    use Sortable;

    protected $table = 'commodities';
    protected $guarded = ['id'];
}
