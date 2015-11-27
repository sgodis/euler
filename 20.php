<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/27
 * Time: 12:50
 */
$result = 1;
$arr = range(1, 100);
foreach($arr as $val){
    $result = bcmul($result, $val);
}
echo array_sum(str_split($result, 1));