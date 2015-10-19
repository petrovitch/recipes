<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;
use Kyslik\ColumnSortable\Sortable;

class Truck extends Auditing
{
    use Sortable;

    protected $table = 'trucks';
    protected $guarded = ['id'];
}
