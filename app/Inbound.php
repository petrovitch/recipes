<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Inbound extends Auditing
{
    protected $table = 'inbounds';

    protected $guarded = ['id'];

    private function getDateValue() {
        return date('m/d/Y', strtotime($this->attributes['delivery_date']));
    }

    private function setDateValue($value) {
        $arr = explode('/', $value);
        $this->attributes['delivery_date'] = $arr[2].'-'.$arr[0].'-'.$arr[1];
    }
}
