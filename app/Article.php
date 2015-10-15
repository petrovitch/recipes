<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Article extends Auditing
{
    protected $table = 'mcc_articles';
    protected $guarded = ['id'];
}
