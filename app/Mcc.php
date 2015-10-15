<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Mcc extends Auditing
{
    protected $table = 'mcc_members';

    protected $guarded = ['id'];
}
