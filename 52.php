<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/12/18
 * Time: 9:27
 */

for($i = 102345; $i <= 1098765432; $i++){
    for($k = 2; $k <= 6; $k++){
        $finalNum = $i * $k;
        if(!empty(compareIgnoreOrder($finalNum, $i))){
            continue 2;
        }
    }
    echo $i;
    break;
}

function compareIgnoreOrder($a, $b)
{
    $arrA = str_split($a);
    $arrB = str_split($b);
    return array_diff($arrA, $arrB);
}
exit;
