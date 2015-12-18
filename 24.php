<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/12/8
 * Time: 9:10
 */

//未完成

/**
A permutation is an ordered arrangement of objects. For example, 3124 is one possible permutation of
the digits 1, 2, 3 and 4. If all of the permutations are listed numerically or alphabetically,
we call it lexicographic order. The lexicographic permutations of 0, 1 and 2 are:

012   021   102   120   201   210

What is the millionth lexicographic permutation of the digits 0, 1, 2, 3, 4, 5, 6, 7, 8 and 9?
 */

$lastNum = 9876543210;
//9个数字时可组成的不同数有362880
$possible = 1 * 2 * 3 * 4 * 5 * 6 * 7 * 8 * 9;

$temp = 1;
for($i = 1; $i <= 9; $i++){
    $result[$i] = $temp = $temp * $i;
}
$result = array_reverse($result);

$request = 1000000;
foreach($result as $val){
    if($request > $val){
        $digit[] = floor($request / $val);
        $request = $request % $val;
    }
}
$numbers = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
$res = '';
foreach($digit as $key => $val){
    $res .= $numbers[$val];
    unset($numbers[$val]);
    sort($numbers);
}

echo $res;
