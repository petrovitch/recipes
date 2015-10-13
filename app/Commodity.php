<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Commodity extends Auditing
{
    protected $table = 'commodities';

    protected $guarded = ['id'];
}
