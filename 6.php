<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/26
 * Time: 11:53
 */
$sumSquare = 0;
for($i = 1; $i <= 100; $i++){
    $sumSquare += $i * $i;
}
$squareSum = pow(array_sum(range(1, 100)), 2);
$result = $squareSum - $sumSquare;
echo $result;