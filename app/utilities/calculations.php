<?php

use Illuminate\Support\Facades\DB;
use Underscore\Types\Arrays;
use Underscore\Types\Number;

//function getCropAcres($loanID, $cropID)
//{
//    $acres = DB::select(DB::raw("SELECT SUM(acres) AS Total FROM loanpractices WHERE loan_id = {$loanID} AND crop_id = {$cropID}"));
//    return $acres[0]->Total;
//}
