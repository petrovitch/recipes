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
        return $this->belongsTo('App\Glcoa', 'acct', 'acct')->withTimestamps();
    }

}
