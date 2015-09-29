<?php namespace App;

use Zizaco\Entrust\EntrustRole;
use OwenIt\Auditing\Auditing;

class Role extends EntrustRole
{
    protected $fillable = ['name', 'display_name', 'description'];
}