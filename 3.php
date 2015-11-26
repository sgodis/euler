<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/26
 * Time: 14:13
 */

$value = 600851475143;
$max = floor(bcsqrt($value));

for($i = $max; $i > 2; $i = $i - 1){
    if($i % 2 == 0) continue;
    if(bcmod($value, $i) == 0){
        for($j = 3; $j < $i; $j = $j + 2){
            if($i % $j == 0){
                continue 2;
            }
        }
        echo $i;
        break;
    }
}