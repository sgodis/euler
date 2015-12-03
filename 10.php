<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/26
 * Time: 17:04
 */
//finish

$result = [2, 3, 5];
$result = 10;
for($i = 7; $i < 2000000; $i = $i + 2){
    if ($i % 5 == 0) continue;
    $max = intval(sqrt($i));
    for($j = 3; $j <= $max; $j = $j + 2){ //此处应小于等于max，一个数整除它的平发根也不是质数
        if($i % $j == 0){
            continue 2;
        }
    }
    $result = bcadd($result, $i);
}
echo $result;
