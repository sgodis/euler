<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/12/8
 * Time: 17:01
 */

$n = 100;
$x = 1;
$y = 1;
$sum = 0;
for($i = 3; $i > 0; $i++){
    $sum = bcadd($x, $y);
    $x = $y;
    $y = $sum;
    //echo $i . '__' . $sum . '<br>';
    if(strlen($sum) >= 1000){
        echo $i . '<br>';
        break;
    }
}
