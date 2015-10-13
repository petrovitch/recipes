<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Zipcode extends Auditing
{
    protected $table = 'zipcodes';

    protected $fillable = ['city', 'sate', 'state_name', 'zipcode', 'county', 'country', 'lat', 'lon'];
}
