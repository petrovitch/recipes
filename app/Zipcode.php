<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;
use Kyslik\ColumnSortable\Sortable;

class Zipcode extends Auditing
{
    use Sortable;

    protected $table = 'zipcodes';
    protected $fillable = ['city', 'sate', 'state_name', 'zipcode', 'county', 'country', 'lat', 'lon'];
}
