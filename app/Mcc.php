<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;
use Kyslik\ColumnSortable\Sortable;

class Mcc extends Auditing
{
    use Sortable;

    protected $table = 'mcc_members';
    protected $guarded = ['id'];
}
