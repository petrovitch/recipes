<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Vendor extends Auditing
{
    protected $table = 'vendors';

    protected $guarded = ['id'];
}
