<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/30
 * Time: 9:40
 */

/**
 * 5×5的螺旋：
 * 21 22 23 24 25
 * 20  7  8  9 10
 * 19  6  1  2 11
 * 18  5  4  3 12
 * 17 16 15 14 13
 * 可以算出对角线上数字之和是101.
 * 求1001×1001的螺旋的螺旋中对角线上数字之和是多少？
 */
//以下为求n×n的过程：
//第n×n的螺旋，一共绕了$spiral个螺旋
function numberSpiralDiagonals($n)
{
    if ($n == 1) return 1;
    if ($n % 2 !== 1) exit('n×n的螺旋，n只能是奇数');
    $spiral = ($n + 1) / 2;
    //result存储对角线4个方向的值，初始都为1
    $result = ['lowRight' => [1], 'lowLeft' => [1], 'topLeft' => [1], 'topRight' => [1]];
    for($i = 2; $i <= $spiral; $i++){
        //第$i圈的值相对于$i-1圈的递增值
        $lowRightInc = 2 * (1 + ($i - 2) * 4);
        $lowLeftInc  = 2 * (2 + ($i - 2) * 4);
        $topLeftInc  = 2 * (3 + ($i - 2) * 4);
        $topRightInc = 2 * (4 + ($i - 2) * 4);
        //第$i圈的值为$i-1圈的值加上递增值
        $result['lowRight'][] = end($result['lowRight']) + $lowRightInc;
        $result['lowLeft'][]  = end($result['lowLeft']) + $lowLeftInc;
        $result['topLeft'][]  = end($result['topLeft']) + $topLeftInc;
        $result['topRight'][] = end($result['topRight']) + $topRightInc;
    }
    $sum = 0;
    foreach($result as $direction => $values){
        foreach($values as $v){
            $sum += $v;
        }
    }
    $sum = $sum - 1 * 3;//1重复出现了4次，取一次值即可
    return $sum;
}

//example: $n = 5; $sum=101;
$n = 1001;
$sum = numberSpiralDiagonals($n);
echo $sum;
