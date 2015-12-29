<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/12/14
 * Time: 16:13
 */

/**
 * The number 3797 has an interesting property. Being prime itself, it is possible to continuously remove digits from left
 * to right, and remain prime at each stage: 3797, 797, 97, and 7. Similarly we can work from right to left: 3797, 379, 37, and 3.

 * Find the sum of the only eleven primes that are both truncatable from left to right and right to left.

 * NOTE: 2, 3, 5, and 7 are not considered to be truncatable primes.
 */

$primes = [2 => 1, 3 => 1, 5 => 1, 7 => 1];
$result = [];
$number = 11;
do{
    $number++;
    if (!isPrimeNumber($number)) {
        continue;
    }
    //是质数
    $primes[$number] = 1;
    $len = strlen($number);
    for ($i = 1; $i < $len; $i++) {
        $left = substr($number, $i);
        if (!isset($primes[$left])) {
            continue 2;
        }
        $right = substr($number, 0, $i);
        if (!isset($primes[$right])) {
            continue 2;
        }
    }
    $result[] = $number;
    if (count($result) == 11) {
        break;
    }

} while (1);
echo array_sum($result);

function isPrimeNumber($number){
    if ($number % 2 == 0) {
        return FALSE;
    }
    $sqrt = sqrt($number);
    if($sqrt == intval($sqrt)){
        return FALSE;
    }else{
        $sqrt = intval($sqrt);
    }
    for($i = 3; $i <= $sqrt; $i = $i + 2){ // 此处应使用<=，比如$number = 35，$sqrt为5，不使用<=则35会判断错误
        if($number % $i == 0){
            return FALSE;
        }
    }
    return TRUE;
}
