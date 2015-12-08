<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/12/1
 * Time: 11:41
 */
/**
 * A perfect number is a number for which the sum of its proper divisors is exactly equal to the number.
 * For example, the sum of the proper divisors of 28 would be 1 + 2 + 4 + 7 + 14 = 28, which means that 28 is a perfect number.

 * A number n is called deficient if the sum of its proper divisors is less than n and it is called abundant if this sum exceeds n.

 * As 12 is the smallest abundant number, 1 + 2 + 3 + 4 + 6 = 16, the smallest number that can be written as the sum of
 * two abundant numbers is 24. By mathematical analysis, it can be shown that all integers greater than 28123 can be written as the sum of
 * two abundant numbers. However, this upper limit cannot be reduced any further by analysis even though it is known that the greatest number
 * that cannot be expressed as the sum of two abundant numbers is less than this limit.

 * Find the sum of all the positive integers which cannot be written as the sum of two abundant numbers.

 */
$upLimit = 28123;
$max = $upLimit - 12;
for($i = 12; $i <= $max; $i++){
    $tempArr = [1];
    $sqrt = sqrt($i);   //sqrt()的结果是浮点数，不能用is_int判断结果是否是整数
    $limit = ceil($sqrt);
    if($sqrt == $limit){
        $tempArr[] = $sqrt;
    }
    for($j = 2; $j < $limit; $j++){
        if($i % $j == 0){
            $tempArr[] = $j;
            $tempArr[] = $i / $j;
        }
    }
    if(array_sum($tempArr) > $i){
        $abundantNumbers[] = $i;
    }
}
$count = count($abundantNumbers);
$result = [];
$all = range(1, 28123);
for($i = 0; $i < $count; $i++){
    for($j = $i; $j < $count; $j++){
        $sum = intval($abundantNumbers[$i] + $abundantNumbers[$j]);
        if($sum <= $upLimit && isset($all[$sum - 1])){
        /* 因为是生成顺序数组，数组值即数组键值减一，所以可使用$sum - 1确定该值
           此处使用isset($all[$sum - 1])来判断值是否存在于1-28123,效率提高了几百倍，
           使用in_array($sum, $all, TRUE)，即使使用第三个参数TRUE限制了判断类型，但
           是在可执行时间300s内根本算不出结果 */
            unset($all[$sum - 1]);
        }
    }
}
echo array_sum($all);

