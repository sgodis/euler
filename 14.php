<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/12/3
 * Time: 9:11
 */

/**
Longest Collatz sequence
Problem 14

The following iterative sequence is defined for the set of positive integers:

n ¡ú n/2 (n is even)
n ¡ú 3n + 1 (n is odd)

Using the rule above and starting with 13, we generate the following sequence:
13 ¡ú 40 ¡ú 20 ¡ú 10 ¡ú 5 ¡ú 16 ¡ú 8 ¡ú 4 ¡ú 2 ¡ú 1

It can be seen that this sequence (starting at 13 and finishing at 1) contains 10 terms. Although it has not been proved yet (Collatz Problem),
it is thought that all starting numbers finish at 1.

Which starting number, under one million, produces the longest chain?

NOTE: Once the chain starts the terms are allowed to go above one million.
 */
$min = intval((1000000 - 1) / 3);
for($i = $min; $i < 1000000; $i++){
    if($i % 2 == 0) continue;
    $result[$i] = getChainLenth($i);
}

echo array_search(max($result), $result);
//print_r(array_keys($result, max($result)));

function getChainLenth($number, $chainLen = 1)
{
    if($number % 2 == 0){
        $temp = $number / 2;
    }else{
        $temp = $number * 3 + 1;
    }
    $chainLen += 1;
    if($temp == 1) return $chainLen;
    return getChainLenth($temp, $chainLen);
}