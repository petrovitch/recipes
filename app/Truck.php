<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Truck extends Auditing
{
    protected $table = 'trucks';

    protected $guarded = ['id'];
}
