<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/26
 * Time: 17:04
 */
//unfinish

$result = [2, 3, 5];
for($i = 7; $i < 10; $i = $i + 2){
    if ($i % 5 == 0) continue;
    for($j = 3; $j < $i; $j = $j + 2){
        if($i % $j == 0){
            continue 2;
        }
    }
    $result[] = $i;
}
echo array_sum($result);

$sum = 0;
$arr = range(1, 200000);
foreach($arr as $val){

}
