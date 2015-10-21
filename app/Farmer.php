<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;
use Kyslik\ColumnSortable\Sortable;

class Farmer extends Auditing
{
    use Sortable;

    protected $table = 'farmers';
    protected $guarded = ['id'];
}
