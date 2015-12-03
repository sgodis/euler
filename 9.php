<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/26
 * Time: 13:35
 */
//当a=b时，a取得最大值，c取得最小值，此时：
//2a? = c?,又因为a+b+c=1000，所以：
//a = c/√2 c = √2a
$maxA = floor(1000 / (2 + sqrt(2)));
$minC = ceil(1000 / (1 + sqrt(2)));

for($a = 1; $a < $maxA; $a++){
    for($c = $minC; $c < 1000; $c++){
        if($c * $c == $a * $a + pow(1000 - $a - $c, 2)){
            echo 'a=' . $a . '<br>';
            echo 'b=' . (1000 - $a - $c) . '<br>';
            echo 'c=' . $c . '<br>';
            echo 'abc=' . $a * (1000 - $a - $c) * $c . '<br>';
        }
    }
}

