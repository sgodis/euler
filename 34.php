<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/12/14
 * Time: 10:57
 */

/**
 * 145 is a curious number, as 1! + 4! + 5! = 1 + 24 + 120 = 145.

 * Find the sum of all numbers which are equal to the sum of the factorial of their digits.

 * Note: as 1! = 1 and 2! = 2 are not sums they are not included.
 * 翻译如下：
 * 145 是一个奇怪的数字, 因为 1! + 4! + 5! = 1 + 24 + 120 = 145.
 * 找出所有等于各位数字阶乘之和的数字之和。
 * 注意: 因为 1! = 1 和 2! = 2 不是和的形式，所以它们不算在内。
 * 注意 : 0! = 1; 零的阶乘是1
 */

$array = [0 => 1, 1 => 1];
for ($i = 2; $i <= 9; $i++) {
    $array[$i] = $i;
    for ($j = $i - 1; $j > 1; $j--) {
        $array[$i] *= $j;

    }
}
//n * 9! > 9 * 10^n 得出 n < 7，即上限不超过9999999，上限应该是 x999999
for ($i = 3; $i <= 2999999; $i++) {
    $digit = str_split($i);
    $temp = 0;
    foreach ($digit as $val) {
        $temp += $array[$val];
    }
    if ($temp == $i) {
        $result[] = $i;
    }
}

echo array_sum($result);
