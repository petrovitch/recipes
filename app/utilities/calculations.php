<?php
use Illuminate\Support\Facades\DB;
use Underscore\Types\Arrays;
use Underscore\Types\Number;

//
// Database Queries
//

/**
 * Get county name from database
 *
 * @param $countyID
 * @return mixed
 */
function getCounty($countyID)
{
    $results = DB::select(DB::raw("SELECT county FROM counties WHERE id = {$countyID}"));
    return $results[0]->county;
}

//
// Miscellaneous
//

function add_date($orgDate, $year, $month, $day)
{
    $cd = strtotime($orgDate);
    $retDAY = date('Y-m-d', mktime(0, 0, 0, date('m', $cd) + $month, date('d', $cd) + $day, date('Y', $cd) + $year));
    return $retDAY;
}

function calculate_age($dob)
{
    $age = date('Y') - date('Y', strtotime($dob));
    if (date('md') < date('md', strtotime($dob))) {
        $age--;
    }
    return $age;
}

function calculate_distance_kilometers($long1, $lat1, $long2, $lat2)
{
    $distance = (3958 * 3.1415926 * sqrt(($lat2 - $lat1) * ($lat2 - $lat1) + cos($lat2 / 57.29578) * cos($lat1 / 57.29578) * ($lon2 - $lon1) * ($lon2 - $lon1)) / 180);
    return $distance;
}

function calculate_distance_miles($long1, $lat1, $long2, $lat2)
{
    $distance = (3958 * 3.1415926 * sqrt(($lat2 - $lat1) * ($lat2 - $lat1) + cos($lat2 / 57.29578) * cos($lat1 / 57.29578) * ($lon2 - $lon1) * ($lon2 - $lon1)) / 180);
    return $distance * 0.6214;
}

function currentDayIsInInterval($begin = '', $end = '')
{
    $preg_exp = '"[0-9][0-9][0-9][0-9]/[0-9][0-9]/[0-9][0-9]"';
    $preg_error = 'Wrong parameter passed to function ' . __FUNCTION__ . ' : Invalide date
format. Please use YYYY/mm/dd.';
    $interval_error = 'First parameter in ' . __FUNCTION__ . ' should be smaller than
second.';
    if (empty($begin)) {
        $begin = 0;
    } else {
        if (preg_match($preg_exp, $begin)) {
            $begin = (int)str_replace('/', '', $begin);
        } else {
            trigger_error($preg_error, E_USER_ERROR);
        }
    }
    if (empty($end)) {
        $end = 99999999;
    } else {
        if (preg_match($preg_exp, $end)) {
            $end = (int)str_replace('/', '', $end);
        } else {
            trigger_error($preg_error, E_USER_ERROR);
        }
    }
    if ($end < $begin) {
        trigger_error($interval_error, E_USER_WARNING);
    }
    $time = time();
    $now = (int)(date('Y', $time) . date('m', $time) . date('j', $time));
    if ($now > $end or $now < $begin) {
        return false;
    }
    return true;
}

function dateDiff($startDate, $endDate)
{
    // Parse dates for conversion
    $startArry = date_parse($startDate);
    $endArry = date_parse($endDate);

    // Convert dates to Julian Days
    $start_date = gregoriantojd($startArry["month"], $startArry["day"], $startArry["year"]);
    $end_date = gregoriantojd($endArry["month"], $endArry["day"], $endArry["year"]);

    // Return difference
    return round(($end_date - $start_date), 0);
}

/**
 * Generate string of digits with leading zeros.
 *
 * 123, 4 -> 0123
 *
 * @param $number
 * @param $num_digits
 * @return string
 */
function leading_zero($number, $num_digits)
{
    $formattedNumber = number_format($number, 0);
    $formattedNumber = str_repeat("0", ($num_digits + -1 - floor(log10($formattedNumber)))) . $formattedNumber;
    return $formattedNumber;
}

function generatePassword($length = 8)
{
    // start with a blank password
    $password = "";
    // define possible characters
    $possible = "0123456789bcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*";
    // set up a counter
    $i = 0;
    // add random characters to $password until $length is reached
    while ($i < $length) {
        // pick a random character from the possible ones
        $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
        // we don't want this character if it's already in the password
        if (!strstr($password, $char)) {
            $password .= $char;
            $i++;
        }
    }
    // done!
    return $password;
}

function generateGuid()
{
    if (function_exists('com_create_guid')) {
        return com_create_guid();
    } else {
        mt_srand((double)microtime() * 10000); //optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45); // "-"
        $uuid = chr(123) // "{"
            . substr($charid, 0, 8) . $hyphen
            . substr($charid, 8, 4) . $hyphen
            . substr($charid, 12, 4) . $hyphen
            . substr($charid, 16, 4) . $hyphen
            . substr($charid, 20, 12)
            . chr(125); // "}"
        return $uuid;
    }
}

function next_weekday($timestamp = NULL)
{
    if ($timestamp === NULL) {
        $timestamp = time();
    } else {
        $timestamp = strtotime(str_replace('/', '-', $timestamp));
    }
    $next = strtotime("midnight +1 day", $timestamp);
    $d = getdate($next);
    if ($d['wday'] == 0 || $d['wday'] == 6) {
        $next = strtotime("midnight next monday", $timestamp);
    }
    return $next;
}

function payment($apr, $n, $pv, $fv = 0.0, $prec = 2)
{
    /* Calculates the monthly payment rouned to the nearest penny
    ** $apr = the annual percentage rate of the loan.
    ** $n  = number of monthly payments (360 for a 30year loan)
    ** $pv    = present value or principal of the loan
    ** $fv  = future value of the loan
    ** $prec = the precision you wish rounded to
    */
    if ($apr != 0) {
        $alpha = 1 / (1 + $apr / 12);
        $retval = round($pv * (1 - $alpha) / $alpha / (1 - pow($alpha, $n)), $prec);
    } else {
        $retval = round($pv / $n, $prec);
    }
    return ($retval);

}

/**
 * Generate QR Code
 */
function qr($chl, $widhtHeight = '150', $EC_level = 'L', $margin = '0')
{
    $url = urlencode($url);
    echo '<img src="http://chart.apis.google.com/chart?chs=' . $widhtHeight .
        'x' . $widhtHeight . '&cht=qr&chld=' . $EC_level . '|' . $margin .
        '&chl=' . $chl . '" alt="QR code" widhtHeight="' . $size .
        '" widhtHeight="' . $size . '"/>';
}

function random_0_1()
{ // auxiliary function
    // returns random number with flat distribution from 0 to 1
    return (float)rand() / (float)getrandmax();
}

function random_gauss()
{ // N(0,1)
    // returns random number with normal distribution:
    //  mean=0
    //  std dev=1

    // auxilary vars
    $x = random_0_1();
    $y = random_0_1();
    // two independent variables with normal distribution N(0,1)
    $u = sqrt(-2 * log($x)) * cos(2 * pi() * $y);
    $v = sqrt(-2 * log($x)) * sin(2 * pi() * $y);
    // i will return only one, couse only one needed
    return $u;
}

function random_gauss_ms($m = 0.0, $s = 1.0)
{ // N(m,s)
    // returns random number with normal distribution:
    //  mean=m
    //  std dev=s
    return gauss() * $s + $m;
}

function random_normal($sine = 0, $percentage = 1)
{
    /*
    Chebyshev rules at least 1 - 1/k2 of the values are within k standard deviations
    from the mean ( ex. 7s 99.99999999974 % ).
    */
    $max = 4;
    do {
        $value = gauss_ms(0, 1);
    } while (abs($value) > $max);
    if ($sine == 0) {
        $value = abs($value);
    }
    if ($percentage > 0) {
        return ($value / $max);
    } else {
        return $value;
    }
}

function random_normal_distribution($mean, $std)
{
    return ($mean + random_normal(1) * $std);
}

function random_sign()
{
    $value = sin(rand(1, 2 * 3.1415));
    if ($value < 0) {
        return -1;
    } else {
        return 1;
    }
}

function random_sine()
{
    return (sin(rand(1, 2 * 3.1415 * 100) / 100));
}

/**
 * Convert Int to Roman Numerals
 */
function romanNumerals($num)
{
    $n = intval($num);
    $res = '';

    /*** roman_numerals array  ***/
    $roman_numerals = array(
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1);

    foreach ($roman_numerals as $roman => $number) {
        /*** divide to get  matches ***/
        $matches = intval($n / $number);

        /*** assign the roman char * $matches ***/
        $res .= str_repeat($roman, $matches);

        /*** substract from the number ***/
        $n = $n % $number;
    }
    return $res;
}

function round_significant($f, $n)
{
    if ($f == 0)
        return $f;
    return round($f, $n - floor(log10(abs($f))) - 1);
}

function saveFileFromTheWeb($remoteFile, $localFile)
{
    $ch = curl_init();
    $timeout = 0;
    curl_setopt($ch, CURLOPT_URL, $remoteFile);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
    $image = curl_exec($ch);
    curl_close($ch);
    $f = fopen($localFile, 'w');
    fwrite($f, $image);
    fclose($f);
}

function strip_newline($var)
{
    $var = preg_replace('/(\\\r|\\\n)/', '', $var);
    return $var;
}

function strip_slashes($var)
{
    $var = preg_replace('/\\\r\\\n/', '~~', $var);
    $var = preg_replace('/[\\\]+/', '', $var);
    $var = preg_replace('/~~/', '\\\r\\\n', $var);
    $var = preg_replace('/\'/', '`', $var);
    return $var;
}

//
// TEXT PROCESSING
//
function gunning_fog_score($text)
{
    return ((average_words_sentence($text) + percentage_number_words_three_syllables($text)) * 0.4) + 5;
}

function calculate_flesch_score($text)
{
    return (206.835 - (1.015 * average_words_sentence($text)) - (84.6 * average_syllables_word($text)));
}

function calculate_flesch_grade($text)
{
    return ((.39 * average_words_sentence($text)) + (11.8 * average_syllables_word($text)) - 15.59);
}

function average_words_sentence($text)
{
    $sentences = strlen(preg_replace('/[^\.!?]/', '', $text));
    $words = strlen(preg_replace('/[^ ]/', '', $text));
    return ($words / $sentences);
}

function average_syllables_word($text)
{
    $words = explode(' ', $text);
    for ($i = 0; $i < count($words); $i++) {
        $syllables = $syllables + count_syllables($words[$i]);
    }
    return ($syllables / count($words));
}

function percentage_number_words_three_syllables($text)
{
    $syllables = 0;
    $words = explode(' ', $text);
    for ($i = 0; $i < count($words); $i++) {
        if (count_syllables($words[$i]) > 2) {
            $syllables++;
        }
    }
    $score = number_format((($syllables / count($words)) * 100));
    return ($score);
}

function count_syllables($word)
{
    $subsyl = Array(
        'cial',
        'tia',
        'cius',
        'cious',
        'giu',
        'ion',
        'iou',
        'sia$',
        '.ely$'
    );

    $addsyl = Array(
        'ia',
        'riet',
        'dien',
        'iu',
        'io',
        'ii',
        '[aeiouym]bl$',
        '[aeiou]{3}',
        '^mc',
        'ism$',
        '([^aeiouy])\1l$',
        '[^l]lien',
        '^coa[dglx].',
        '[^gq]ua[^auieo]',
        'dnt$'
    );

    // Based on Greg Fast's Perl module Lingua::EN::Syllables
    $word = preg_replace('/[^a-z]/is', '', strtolower($word));
    $word_parts = preg_split('/[^aeiouy]+/', $word);
    foreach ($word_parts as $key => $value) {
        if ($value <> '') {
            $valid_word_parts[] = $value;
        }
    }

    $syllables = 0;
    foreach ($subsyl as $syl) {
        if (strpos($word, $syl) !== false) {
            $syllables--;
        }
    }
    foreach ($addsyl as $syl) {
        if (strpos($word, $syl) !== false) {
            $syllables++;
        }
    }
    if (strlen($word) == 1) {
        $syllables++;
    }
    $syllables += count($valid_word_parts);
    $syllables = ($syllables == 0) ? 1 : $syllables;
    return $syllables;
}

//
function tokenize($text)
{
    $token = strtok($keywords, ' ');
    while ($token) {
        if ($token{0} == '"') {
            $token .= ' ' . strtok('"') . '"';
        }
        if ($token{0} == "'") {
            $token .= ' ' . strtok("'") . "'";
        }
        $tokens[] = $token;
        $token = strtok(' ');
    }
    return $tokens;
}

//
// STATISTICS
//

/* Square */
function sq($x)
{
    return $x * $x;
}

/* Solve Equation */
function solve($eq)
{
    $eq = str_replace(' ', '', $eq);
    // validate expression
    $terms = explode('=', $eq);
    if (count($terms) != 2) {
        return ('syntax error: you must have one (and only one) "=" in [' . $eq . '].');
    }
    // put rhs in lhs
    $eq = $terms[0] . '-(' . $terms[1] . ')';
    if (substr_count($eq, '(') != substr_count($eq, ')')) {
        return ('syntax error: parenthesis mismatch in [' . $eq . '].');
    }
    if (preg_match('/\([^)]*\(/', $eq)) {
        return ('syntax error: only one level of parenthesis allowed in [' . $eq . '].');
    }
    if (preg_match('/[^x0-9+*\/().=-]/', $eq)) {
        return ('syntax error: the only valid characters are x, 0-9, +, ' . '*, /, (, ), ., and - in [' . $eq . ']');
    }
    if (preg_match('/[^x0-9\)][-+\/*]/', $eq)) {
        return ('syntax error: you can only operate on numbers in [' . $eq . ']');
    }
    if (preg_match('/[-+\/*][^x0-9\(]/', $eq)) {
        return ('syntax error: you can only operate on numbers in [' . $eq . ']');
    }
    $eq = str_replace('x', '$x', $eq);
    $y0 = $y1 = 0;
    $x = 0;
    eval ('$y0 = ' . $eq . ';');
    $x = 1;
    eval ('$y1 = ' . $eq . ';');
    $slope = $y1 - $y0;
    $intersect = $y0;
    return (-($intersect / $slope));
}

function differential($equa)
{
    $equa = strtolower($equa);
    echo "Equation de depart: " . $equa . "<br>";
    $final = "";
    for ($i = 0; $i < strlen($equa); $i++) {
        //Make a new string from the receive $equa
        if ($equa{
            $i}
            == "x" && $equa{
            $i + 1}
            == "^"
        ) {
            $final .= $equa{
            $i + 2};
            $final .= "x^";
            $final .= $equa{
                $i + 2}
                - 1;
        } elseif ($equa{
            $i}
            == "+" || $equa{
            $i}
            == "-"
        ) {
            $final .= $equa{
            $i};
        } elseif (is_numeric($equa{
            $i}) && $i == 0
        ) {
            //gerer parenthese et autre terme generaux + gerer ^apres: 2^2
            $final .= $equa{
                $i}
                . "*";
        } elseif (is_numeric($equa{
            $i}) && $i > 0 && $equa{
            $i - 1}
            != "^"
        ) {
            //gerer ^apres: 2^2
            $final .= $equa{
                $i}
                . "*";
        } elseif ($equa{
            $i}
            == "^"
        ) {
            continue;
        } elseif (is_numeric($equa{
            $i}) && $equa{
            $i - 1}
            == "^"
        ) {
            continue;
        } else {
            if ($equa{
                $i}
                == "x"
            ) {
                $final .= 1;
            } else {
                $final .= $equa{
                $i};
            }
        }
    }
    //Manage multiplication add in the previous string $final
    $finalMul = "";
    for ($i = 0; $i < strlen($final); $i++) {
        if (is_numeric($final{
            $i}) && $final{
            $i + 1}
            == "*" && is_numeric($final{
            $i + 2})
        ) {
            $finalMul .= $final{
                $i}
                * $final{
                $i + 2};
        } elseif ($final{
            $i}
            == "*"
        ) {
            continue;
        } elseif (is_numeric($final{
            $i}) && $final{
            $i + 1}
            != "*" && $final{
            $i - 1}
            == "*"
        ) {
            continue;
        } else {
            $finalMul .= $final{
            $i};
        }
    }
    echo "equa final: " . $finalMul;
}

/* Combinations */
function nCr($n, $r)
{
    if ($r > $n) {
        return NaN;
    }
    if (($n - $r) < $r) {
        return nCr($n, ($n - $r));
    }
    $return = 1;
    for ($i = 0; $i < $r; $i++) {
        $return *= ($n - $i) / ($i + 1);
    }
    return $return;
}

/* Permutations */
function nPr($n, $r)
{
    if ($r > $n) {
        return NaN;
    }
    if ($r) {
        return $n * (nPr($n - 1, $r - 1));
    } else {
        return 1;
    }
}

/* Accumulative Total */
function accumulative($input_array, $k)
{
    $total = 0;
    for ($i = 0; $i < $k; $i++) {
        $total += $input_array[$i];
    }
    return $total;
}

/* Sum */
function sum($input_array)
{
    $total = 0;
    foreach ($input_array as $value) {
        $total += $value;
    }
    return $total;
}

/* Mean */
function mean($input_array)
{
    $total = 0;
    foreach ($input_array as $value) {
        $total += $value;
    }
    return ($total / count($input_array));
}

/* Median */
function median($input_array)
{
    sort($input_array);
    if (count($input_array) % 2) {
        return ($input_array[floor(count($input_array) / 2)]);
    } else {
        return (($input_array[count($input_array) / 2 - 1] + $input_array[count($input_array) / 2]) / 2);
    }
}

/* Mode */
function mode($input_array)
{
    $work = array_count_values($input_array);
    arsort($work);
    reset($work);
    list ($value, $check) = each($work);
    $last = $check;
    $output = array(
        $value
    );
    while (list ($value, $check) = each($work)) {
        if ($check < $last) {
            break;
        }
        $output[] = $value;
    }
    if (count($output) == 1) {
        return ($output[0]);
    } else {
        return ($output);
    }
}

/* Range */
function range_of_data($arr)
{
    return max($arr) - min($arr);
}

/* Midrange */
function midrange($arr)
{
    return (min($arr) + max($arr)) / 2;
}

/* Mean Deviation */
function md($arr)
{
    $n = sizeof($arr);
    $mean = mean($arr);
    $sum = 0;
    for ($i = 0; $i < $n; $i++) {
        $sum += ($arr[$i] - $mean);
    }
    return $sum / $n;
}

/* Mean Absolute Deviation */
function mad($arr)
{
    $n = sizeof($arr);
    $mean = mean($arr);
    $sum = 0;
    for ($i = 0; $i < $n; $i++) {
        $sum += abs($arr[$i] - $mean);
    }
    return $sum / $n;
}

/* Mean Squared Error */
function mse($arr)
{
    $n = sizeof($arr);
    $mean = mean($arr);
    $sum = 0;
    for ($i = 0; $i < $n; $i++) {
        $sum += ($arr[$i] - $mean) * ($arr[$i] - $mean);
    }
    return $sum / $n;
}

/* Z Scores */
function z($var, $arr)
{
    return ($var - mean($arr)) / std($arr);
}

/* Skewness */
function sk($arr)
{
    $sk = (3 * (mean($arr) - md($arr))) / std($arr);
}

/* Variance */
function variance($arr)
{
    if (!count($arr))
        return 0;
    $mean = mean($arr);
    $sos = 0; // Sum of squares
    for ($i = 0; $i < count($arr); $i++) {
        $sos += ($arr[$i] - $mean) * ($arr[$i] - $mean);
    }
    return $sos / (count($arr) - 1);
}

/* Standard Deviation */
function std($arr)
{
    if (!count($arr))
        return 0;
    $mean = mean($arr);
    $sos = 0; // Sum of squares
    for ($i = 0; $i < count($arr); $i++) {
        $sos += ($arr[$i] - $mean) * ($arr[$i] - $mean);
    }
    return sqrt($sos / (count($arr) - 1));
}

/* Standard Deviation */
function standard_deviation($arr)
{
    return std($arr);
}

/* Standard Error of the Mean */
function sem($arr)
{
    $n = sizeof($arr);
    $std = std($arr);
    $sem = $std / sqrt($n);
    return $sem;
}

/* Coefficient of Variation */
function coefficient_of_variation($arr)
{
    return std($arr) / mean($arr) * 100;
}

//
// BIVARIANT
//

/* Autocorrelation */
function rk($x, $y, $k = 1)
{
    $n = sizeof($x);
    $sumx = array_sum($x);
    $sumy = array_sum($y);
    $x_bar = $sumx / $n;
    $y_bar = $sumy / $n;
    for ($i = 0; $i < ($n - $k); $i++) {
        $sumxx += ($x[$i] - $x_bar) * ($x[$i + $k] - $x_bar);
        $sumxx2 += ($x[$i] - $x_bar) * ($x[$i] - $x_bar);
    }
    return $sumxx / $sumxx2;
}

/* Cross Autocorrelation */
function rxy($x, $y, $k = 1)
{
    $n = sizeof($x);
    $sumx = array_sum($x);
    $sumy = array_sum($y);
    $x_bar = $sumx / $n;
    $y_bar = $sumy / $n;
    for ($i = 0; $i < ($n - $k); $i++) {
        $sumxx += ($x[$i] - $x_bar) * ($x[$i + $k] - $x_bar);
        $sumxy += ($x[$i] - $x_bar) * ($y[$i + $k] - $y_bar);
        $sumxx2 += ($x[$i] - $x_bar) * ($x[$i] - $x_bar);
        $sumyy2 += ($y[$i] - $y_bar) * ($y[$i] - $y_bar);
    }
    return $sumxx / (sqrt($sumxx2) * sqrt($sumyy2));
}

/* Covariance */
function cov($x, $y)
{
    $n = sizeof($x);
    $sumx = array_sum($x);
    $sumy = array_sum($y);
    for ($i = 0; $i < $n; $i++) {
        $sumxy += ($x[$i] * $y[$i]);
        $sumx2 += ($x[$i] * $x[$i]);
        $sumy2 += ($y[$i] * $y[$i]);
    }
    $ssxy = $sumxy - ($sumx * $sumy) / $n;
    $cov = ((1 / ($n - 1)) * $ssxy);
    return $cov;
}

/* Coefficient of Correlation */
function r($x, $y)
{
    $n = sizeof($x);
    $sumx = array_sum($x);
    $sumy = array_sum($y);
    for ($i = 0; $i < $n; $i++) {
        $sumxy += ($x[$i] * $y[$i]);
        $sumx2 += ($x[$i] * $x[$i]);
        $sumy2 += ($y[$i] * $y[$i]);
    }
    $r = ($sumxy - $sumx * $sumy / $n) / sqrt(($sumx2 - $sumx * $sumx / $n) * ($sumy2 - $sumy * $sumy / $n));
    return $r;
}

/* Coefficient of Correlation */
function coefficient_of_correlation($x, $y)
{
    return r($x, $y);
}

/* Coefficient of Determination */
function r2($x, $y)
{
    $n = sizeof($x);
    $sumx = array_sum($x);
    $sumy = array_sum($y);
    for ($i = 0; $i < $n; $i++) {
        $sumxy += ($x[$i] * $y[$i]);
        $sumx2 += ($x[$i] * $x[$i]);
        $sumy2 += ($y[$i] * $y[$i]);
    }
    $r = ($sumxy - $sumx * $sumy / $n) / sqrt(($sumx2 - $sumx * $sumx / $n) * ($sumy2 - $sumy * $sumy / $n));
    return $r * $r;
}

/* Coefficient of Determination */
function coefficient_of_determination($x, $y)
{
    return r2($x, $y);
}

/* Simple Linear Regression: Slope */
function slope($x, $y)
{
    $n = sizeof($x);
    $sumx = array_sum($x);
    $sumy = array_sum($y);
    for ($i = 0; $i < $n; $i++) {
        $sumxy += ($x[$i] * $y[$i]);
        $sumx2 += ($x[$i] * $x[$i]);
        $sumy2 += ($y[$i] * $y[$i]);
    }
    $b = ($sumxy - ($sumx * $sumy) / $n) / ($sumx2 - ($sumx * $sumx) / $n);
    return $b;
}

/* Simple Linear Regression: Intercept */
function intercept($x, $y)
{
    $n = sizeof($x);
    $sumx = array_sum($x);
    $sumy = array_sum($y);
    for ($i = 0; $i < $n; $i++) {
        $sumxy += ($x[$i] * $y[$i]);
        $sumx2 += ($x[$i] * $x[$i]);
        $sumy2 += ($y[$i] * $y[$i]);
    }
    $b = ($sumxy - ($sumx * $sumy) / $n) / ($sumx2 - ($sumx * $sumx) / $n);
    $a = ($sumy - $b * $sumx) / $n;
    return $a;
}

/* Simple Linear Regression: Intercept */
function a($x, $y)
{
    return intercept($x, $y);
}

/* Simple Linear Regression: Slope */
function b($x, $y)
{
    return slope($x, $y);
}

/* Standard Error of the Estimate */
function see($x, $y)
{
    $n = sizeof($x);
    $sumx = array_sum($x);
    $sumy = array_sum($y);
    for ($i = 0; $i < $n; $i++) {
        $sumxy += ($x[$i] * $y[$i]);
        $sumx2 += ($x[$i] * $x[$i]);
        $sumy2 += ($y[$i] * $y[$i]);
    }
    $b = ($sumxy - ($sumx * $sumy) / $n) / ($sumx2 - ($sumx * $sumx) / $n);
    $a = ($sumy - $b * $sumx) / $n;
    for ($i = 0; $i < $n; $i++) {
        $sse += ($y[$i] - ($a + $b * $x[$i])) * ($y[$i] - ($a + $b * $x[$i]));
    }
    $see = sqrt($sse / ($n - 2));
    return $see;
}

/* Sum of the Squared Errors */
function sse($x, $y)
{
    $n = sizeof($x);
    $sumx = array_sum($x);
    $sumy = array_sum($y);
    for ($i = 0; $i < $n; $i++) {
        $sumxy += ($x[$i] * $y[$i]);
        $sumx2 += ($x[$i] * $x[$i]);
        $sumy2 += ($y[$i] * $y[$i]);
    }
    $ssx = $sumx2 - ($sumx * $sumx) / $n;
    $ssy = $sumy2 - ($sumy * $sumy) / $n;
    $ssxy = $sumxy - ($sumx * $sumy) / $n;
    $sse = $ssy - ($ssxy * $ssxy) / $ssx;
    return $sse;
}

/* Residual Variance */
function residual_variance($x, $y)
{
    $n = sizeof($x);
    $sumx = array_sum($x);
    $sumy = array_sum($y);
    for ($i = 0; $i < $n; $i++) {
        $sumxy += ($x[$i] * $y[$i]);
        $sumx2 += ($x[$i] * $x[$i]);
        $sumy2 += ($y[$i] * $y[$i]);
    }
    $ssx = $sumx2 - ($sumx * $sumx) / $n;
    $ssy = $sumy2 - ($sumy * $sumy) / $n;
    $ssxy = $sumxy - ($sumx * $sumy) / $n;
    $sse = $ssy - ($ssxy * $ssxy) / $ssx;
    $residual_variance = $sse / ($n - 2);
    return $residual_variance;
}

/* t Statistic */
function t($x, $y)
{
    $n = sizeof($x);
    $sumx = array_sum($x);
    $sumy = array_sum($y);
    for ($i = 0; $i < $n; $i++) {
        $sumxy += ($x[$i] * $y[$i]);
        $sumx2 += ($x[$i] * $x[$i]);
        $sumy2 += ($y[$i] * $y[$i]);
    }
    $ssx = $sumx2 - ($sumx * $sumx) / $n;
    $ssy = $sumy2 - ($sumy * $sumy) / $n;
    $ssxy = $sumxy - ($sumx * $sumy) / $n;
    $r = $ssxy / (sqrt($ssx) * sqrt($ssy));
    $r2 = $r * $r;
    $t = $r / sqrt((1 - $r2) / ($n - 2));
    return $t;
}

/* F Statistic */
function F($x, $y)
{
    $n = sizeof($x);
    $sumx = array_sum($x);
    $sumy = array_sum($y);
    for ($i = 0; $i < $n; $i++) {
        $sumxy += ($x[$i] * $y[$i]);
        $sumx2 += ($x[$i] * $x[$i]);
        $sumy2 += ($y[$i] * $y[$i]);
    }
    $ssx = $sumx2 - ($sumx * $sumx) / $n;
    $ssy = $sumy2 - ($sumy * $sumy) / $n;
    $ssxy = $sumxy - ($sumx * $sumy) / $n;
    $r = $ssxy / (sqrt($ssx) * sqrt($ssy));
    $r2 = $r * $r;
    $t = $r / sqrt((1 - $r2) / ($n - 2));
    $F = $t * $t;
    return $F;
}

/**
 * Square root transformation
 *
 * Useful for normalizing counts
 */
function normalize_sqrt($vector)
{
    foreach ($vector as $count)
        $sqrt_vector[] = sqrt($count);
    return $sqrt_vector;
}

/**
 * Logit transformation
 *
 * Useful for normalizing proportions p
 */
function logit($vector)
{
    foreach ($vector as $p)
        $logit_vector[] = 0.5 * log($p / (1 - $p));
    return $logit_vector;
}

/**
 * Fisher z-transformation
 *
 * Useful for normalizing correlations r
 */
function fisherz($vector)
{
    foreach ($vector as $r)
        $fisherz_vector[] = 0.5 * log((1 + $r) / (1 - $r));
    return $fisherz_vector;
}

/**
 * Box-Cox power transformation
 *
 * Sligthly modified power transformation
 */
function boxcox($vector, $exponent)
{
    if ($exponent != 0) {
        foreach ($vector as $value)
            $boxcox_vector[] = ((pow($value, $exponent) - 1) / $exponent);
    } else {
        foreach ($vector as $value)
            $boxcox_vector[] = log($value);
    }
    return $boxcox_vector;
}

/**
 * Matrix Addition
 */
function matrix_addition($rows, $cols, $m1, $m2)
{
    $m3 = array();
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            $m3[$i][$j] = $m1[$i][$j] + $m2[$i][$j];
        }
    }
    return ($m3);
}

/**
 * Matrix Subtraction
 */
function matrix_subtraction($rows, $cols, $m1, $m2)
{
    $m3 = array();
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            $m3[$i][$j] = $m1[$i][$j] - $m2[$i][$j];
        }
    }
    return ($m3);
}

/**
 * Matrix Multiplication
 */
function matrix_multiplication($rows, $cols, $m1, $m2)
{
    $m3 = array();
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            $x = 0;
            for ($k = 0; $k < $cols; $k++) {
                $x += $m1[$i][$k] * $m2[$k][$j];
            }
            $m3[$i][$j] = $x;
        }
    }
    return ($m3);
}

/**
 * Matrix Transposition
 */
function matrix_transpose($rows, $cols, $m1)
{
    $m2 = array();
    for ($i = 0; $i < $rows; $i++) {
        for ($j = 0; $j < $cols; $j++) {
            $m2[$j][$i] = $m1[$i][$j];
        }
    }
    return ($m2);
}

/**
 * Show Matrix
 */
function showMatrix($matrix, $rows, $cols)
{
    echo "<br><br>";
    echo "<table border=0>";
    for ($i = 0; $i < $rows; $i++) {
        echo "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            echo "<td align=right width=60>" . number_format($matrix[$i][$j], 4) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

/**
 * Multiple Matrix Row by a Cell Value. Fix "1" in each position on the diagonal
 * of the identity matrix.
 */
function multRowByCell($matrix, $row_num, $max_cols, $cell_value)
{
    for ($j = 0; $j < $max_cols; $j++) {
        $matrix[$row_num][$j] *= $cell_value;
    }
    return $matrix;
}

/**
 * Matrix Row Operation: Add row mutiplied by a factor to another row to eliminate
 * variables off of the identity matrix diagonal.
 */
function addRowByRow($matrix, $row_selected, $row_factor, $row_targeted, $max_cols)
{
    for ($j = 0; $j < $max_cols; $j++) {
        $matrix[$row_targeted][$j] += $matrix[$row_selected][$j] * $row_factor;
    }
    return $matrix;
}

/**
 * Find the inverse of a matrix.
 */
function inverse_matrix($matrix, $max_rows, $max_cols)
{
    if ($max_rows != $max_cols) {
        echo "Non-square matrices (m-by-n matrices for which m ? n) do not have an inverse.";
        die();
    }
    for ($k = 0; $k < $max_rows; $k++) {
        if ($matrix[$k][$k] < 0) {
            $neg = "-";
        } else {
            $neg = "";
        }
        $matrix = multRowByCell($matrix, $k, $max_cols * 2, $neg . abs(1 / $matrix[$k][$k]));
        for ($i = 0; $i < $max_rows; $i++) {
            if ($i != $k) {
                if ($matrix[$i][$k] != 0) {
                    $matrix = addRowByRow($matrix, $k, -$matrix[$i][$k], $i, $max_cols * 2);
                }
            }
        }
    }
    for ($i = 0; $i < $max_rows; $i++) {
        for ($j = 0; $j < $max_cols; $j++) {
            $inverse_matrix[$i][$j] = $matrix[$i][$j + $max_cols];
        }
    }
    return $inverse_matrix;
}

function getImagesList($path)
{
    $ctr = 0;
    if ($img_dir = @opendir($path)) {
        while (false !== ($img_file = readdir($img_dir))) {
// add checks for other image file types here, if you like
            if (preg_match("/(\.gif|\.jpg)$/", $img_file)) {
                $images[$ctr] = $img_file;
                $ctr++;
            }
        }
        closedir($img_dir);
        return $images;
    } else {
        return false;
    }
}

//
// Zip Files
//

/* creates a compressed zip file */
function create_zip($files = array(), $destination = '', $overwrite = false)
{
    //if the zip file already exists and overwrite is false, return false
    if (file_exists($destination) && !$overwrite) {
        return false;
    }
    //vars
    $valid_files = array();
    //if files were passed in...
    if (is_array($files)) {
        //cycle through each file
        foreach ($files as $file) {
            //make sure the file exists
            if (file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
    //if we have good files...
    if (count($valid_files)) {
        //create the archive
        $zip = new ZipArchive();
        if ($zip->open($destination, $overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
        }
        //add the files
        foreach ($valid_files as $file) {
            $zip->addFile($file, $file);
        }
        //debug
        //echo 'The zip archive contains ',$zip-&gt;numFiles,' files with a status of ',$zip-&gt;status;

        //close the zip -- done!
        $zip->close();

        //check to make sure the file exists
        return file_exists($destination);
    } else {
        return false;
    }
}

/**
 * Finds path, relative to the given root folder, of all files and directories in the given directory and its sub-directories non recursively.
 * Will return an array of the form
 * array(
 *   'files' => [],
 *   'dirs'  => [],
 * )
 * @author sreekumar
 * @param string $root
 * @result array
 */
function read_all_files($root = '.')
{
    $files = array('files' => array(), 'dirs' => array());
    $directories = array();
    $last_letter = $root[strlen($root) - 1];
    $root = ($last_letter == '\\' || $last_letter == '/') ? $root : $root . DIRECTORY_SEPARATOR;

    $directories[] = $root;

    while (sizeof($directories)) {
        $dir = array_pop($directories);
        if ($handle = opendir($dir)) {
            while (false !== ($file = readdir($handle))) {
                if ($file == '.' || $file == '..') {
                    continue;
                }
                $file = $dir . $file;
                if (is_dir($file)) {
                    $directory_path = $file . DIRECTORY_SEPARATOR;
                    array_push($directories, $directory_path);
                    $files['dirs'][] = $directory_path;
                } elseif (is_file($file)) {
                    $files['files'][] = $file;
                }
            }
            closedir($handle);
        }
    }
    return $files;
}

?>