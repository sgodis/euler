<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2016/1/12
 * Time: 10:36
 */
//动态规划解决钢条切割问题

$arr = [1 => 1, 2 => 5, 3 => 8, 4 => 9, 5 => 10, 6 => 17, 7 => 17, 8 => 20, 9 => 24, 10 => 30];

function steelCutting($arr, $len)
{
    static $maxProfit = [];
    if (isset($maxProfit[$len])) {
        return $maxProfit[$len];
    }
    $temp = 0;
    if ($len == 0) {
        $temp = 0;
    } else {
        for ($i = 1; $i <= $len; $i++) {
            $temp = max($temp, $arr[$i] + steelCutting($arr, $len - $i));
        }
    }
    $maxProfit[$len] = $temp;
    return $temp;
}
$result = steelCutting($arr, 10);
echo $result;
