<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;
use Kyslik\ColumnSortable\Sortable;

class Customer extends Auditing
{
    use Sortable;

    protected $table = 'customers';
    protected $guarded = ['id'];
}
