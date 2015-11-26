<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/26
 * Time: 11:00
 */
$array = [2, 3, 5];
$next = 7;
do{
    $value = $next;
    $next = $value + 1;
    if($value % 2 == 0 || $value % 5 == 0) continue;
    for($i = 3; $i < $value; $i++){
        if($value % $i == 0){
           continue 2;
        }
    }
    $array[] = $value;
}while(count($array) <= 10000);
echo end($array);
