<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Dpr extends Auditing
{
    protected $table = 'dprs';

    protected $guarded = ['id'];
}
