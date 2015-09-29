<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class AuditTrail extends Auditing
{
    protected $table = 'logs';
}
