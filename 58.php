<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/12/18
 * Time: 14:20
 */
/*
 * tip:愚蠢的我用round($proportion['prime'] / $proportion['total'], 2) < 0.1
 * 导致结果的比较完全不准确，因为在递增过程，有n个0.9999xxxxx的结果存在
 * 结果是程序早就写出来，但是多调试了一个小时。。。我宝贵的青春~~~ =.=
 */

$result = ['lowRight' => 1, 'lowLeft' => 1, 'topLeft' => 1, 'topRight' => 1];
$proportion = ['total' => 1, 'prime' => 0]; //默认从1开始，total包括1
$i = 2; //第$i圈
do {
    $temp = [];
    $lowRightInc = 2 * (1 + ($i - 2) * 4);
    $lowLeftInc  = 2 * (2 + ($i - 2) * 4);
    $topLeftInc  = 2 * (3 + ($i - 2) * 4);
    $topRightInc = 2 * (4 + ($i - 2) * 4);
    $result['lowRight'] = $result['lowRight'] + $lowRightInc;
    $result['lowLeft']  = $result['lowLeft'] + $lowLeftInc;
    $result['topLeft']  = $result['topLeft'] + $topLeftInc;
    $result['topRight'] = $result['topRight'] + $topRightInc;
    $proportion['total'] += 4;
    foreach($result as $val){
        if(isPrimeNumber($val)){
            $proportion['prime'] += 1;
        }
    }
    if($proportion['prime'] / $proportion['total'] < 0.1){
        break;
    }
    $i++;
} while (TRUE);

echo $i * 2 - 1; //计算长度

/**
 * 判断是否质数，是质数返回TRUE
 * @param $number
 * @return bool
 */
function isPrimeNumber($number){ //此方法另参考37.php
    $sqrt = sqrt($number);
    if($sqrt == intval($sqrt)){
        return FALSE;
    }else{
        $sqrt = intval($sqrt);
    }
    for($i = 3; $i < $sqrt; $i = $i + 2){
        if($number % $i == 0){
            return FALSE;
        }
    }
    return TRUE;
}

