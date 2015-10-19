<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;
use Kyslik\ColumnSortable\Sortable;

class Quote extends Auditing
{
    use Sortable;

    protected $table = 'mcc_quotes';
    protected $guarded = ['id'];
}
