<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/26
 * Time: 17:04
 */
//finish

$result = [2, 3, 5];
$result = 10;
for($i = 7; $i < 2000000; $i = $i + 2){
    if ($i % 5 == 0) continue;
    $max = intval(sqrt($i));
    for($j = 3; $j <= $max; $j = $j + 2){ //�˴�ӦС�ڵ���max��һ������������ƽ����Ҳ��������
        if($i % $j == 0){
            continue 2;
        }
    }
    $result = bcadd($result, $i);
}
echo $result;
