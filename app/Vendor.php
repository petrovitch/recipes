<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;
use Kyslik\ColumnSortable\Sortable;

class Vendor extends Auditing
{
    use Sortable;

    protected $table = 'vendors';
    protected $guarded = ['id'];
}
