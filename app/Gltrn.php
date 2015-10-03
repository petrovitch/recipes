<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Gltrn extends Auditing
{
    protected $table = 'gltrns';

    protected $fillable = ['acct', 'description', 'date', 'document', 'amount'];

    public function glcoa()
    {
        return $this->belongsTo('App\Glcoa', 'acct', 'acct');
    }

    private function getDateValue() {
        return date('m/d/Y', strtotime($this->attributes['date']));
    }

    private function setDateValue($value) {
        $arr = explode('/', $value);
        $this->attributes['date'] = $arr[2].'-'.$arr[0].'-'.$arr[1];
    }
}
