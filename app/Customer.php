<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Customer extends Auditing
{
    protected $table = 'customers';

    protected $guarded = ['id'];
}
