<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/30
 * Time: 16:37
 */
/**
 * https://projecteuler.net/problem=29
 * 解题思路：指定范围内的值存在指数结果仍在指定范围，则会出现重复，如：
 * 2^2指数结果为4,10^2的指数为100，则2和4，10和100的指数结果集会出现重复
 */
//可传参的array_map
function local_array_map($array, $variable)
{
    $multi = function($item) use ($variable)
    {
        return $item * $variable;
    };
    return array_map($multi, $array);
}
$hasSqrt = [];
$relation = [];
for($i = 2; $i <= 10; $i++){
    for($j = 1; $j <= 6; $j++){
        $temp = pow($i, $j);
        if($temp <= 100){
            $hasSqrt[] = $temp;
            $relation[$i][$j] = $temp;
        }
    }
}
$array = range(2, 100); //所有2-100的数都有2-100的指数
$hasSqrt = array_unique($hasSqrt);
$withoutSqrt = array_diff($array, $hasSqrt);
$withoutSqrtDistinct = count($withoutSqrt) * 99; //获取不存在相同指数结果的数的指数数量

//4,8已在2的结果中出现，9已在3的结果中出现，所以unset
unset($relation[4]);
unset($relation[8]);
unset($relation[9]);
foreach($relation as $root => $value){
    $tempArr = [];
    foreach($value as $exp => $power){
        $tempArr = array_merge($tempArr, local_array_map($array, $exp));
    }
    $unique = array_unique($tempArr);
    $result[$root] = count($unique);//以root为根的不同指数数量
}
$hasSqrtDistinct = array_sum($result);
$total = $withoutSqrtDistinct + $hasSqrtDistinct;
echo $total;

