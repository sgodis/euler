<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/26
 * Time: 13:35
 */
//��a=bʱ��aȡ�����ֵ��cȡ����Сֵ����ʱ��
//2a? = c?,����Ϊa+b+c=1000�����ԣ�
//a = c/��2 c = ��2a
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

