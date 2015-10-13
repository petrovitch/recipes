<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Outbound extends Auditing
{
    protected $table = 'outbounds';

    protected $guarded = ['id'];
}
