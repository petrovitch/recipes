<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use OwenIt\Auditing\Auditing;

class Recipe extends Auditing
{
    use Sortable;

    protected $table = 'recipes';
    protected $guarded = ['id'];
}
