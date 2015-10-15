<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Quote extends Auditing
{
    protected $table = 'mcc_quotes';
    protected $guarded = ['id'];
}
