<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditing;

class Recipe extends Auditing
{
    protected $table = 'recipes';

    protected $fillable = ['category', 'name', 'author', 'recipe', 'instructions', 'microwave'];
}
