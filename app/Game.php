<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Game extends Auditing
{
    protected $table = 'mcc_games';
    protected $guarded = ['id'];

    public function ecos()
    {
        return $this->has('App\Eco', 'eco', 'eco');
    }
}
