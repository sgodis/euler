<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/12/29
 * Time: 9:19
 */

/**
 * 三角数，五角数和六角数分别通过以下公式定义：
 * 三角数 		Tn=n(n+1)/2 		1, 3, 6, 10, 15, ...
 * 五角数 		Pn=n(3n−1)/2 		1, 5, 12, 22, 35, ...
 * 六角数 		Hn=n(2n−1) 		1, 6, 15, 28, 45, ...
 * 可以证实 T285 = P165 = H143 = 40755.
 * 找出这之后的下一个既是五角数又是六角数的三角数。
 */

$i = 144;
$j = 165;

do {
    $hexagonal = $i * ($i * 2 - 1);
    do {
        $j++;
        $pentagonal = $j * ($j * 3 - 1) / 2;
        if ($pentagonal == $hexagonal) {
            echo $pentagonal;
            echo '<br>';
            echo $hexagonal;
            break 2;
        } elseif ($pentagonal > $hexagonal) {
            break;
        }
    } while (1);
    $i++;
    //if ($i > 100000) { //防止卡死
    //    break;
    //}
} while (1);
