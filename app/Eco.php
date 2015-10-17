<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Eco extends Auditing
{
    protected $table = 'mcc_ecos';
    protected $guarded = ['id'];

    public function games()
    {
        return $this->has('App\Game', 'eco', 'eco');
    }
}
