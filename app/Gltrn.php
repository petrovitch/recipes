<?php

namespace App;

use Carbon\Cargon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Gltrn extends Auditing
{
    protected $table = 'gltrns';
    protected $guarded = ['id'];
//    protected $dates = ['date'];

    public function glcoa()
    {
        return $this->belongsTo('App\Glcoa', 'acct', 'acct');
    }

//    private function getDate($value) {
//        return $value->format('m/d/Y');
//    }

//    private function setDateAttribute($date) {
//        $this->attributes['date'] = Carbon::createFromFormat('Y-m-d', $date);
//    }
}
