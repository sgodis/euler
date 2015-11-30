<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/30
 * Time: 12:43
 */
function func($v)
{
    return pow($v, 5);
};
$maxVal = pow(9, 5) * 5;
$result = 0;
for($i = 2; $i <= $maxVal; $i++){
    $digits = str_split($i, 1);
    $digits = array_map('func', $digits);
    if ($i == array_sum($digits)){
        $result += $i;
    }
}
echo $result;
