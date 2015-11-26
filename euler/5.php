<?php
//获取数组内不被整除的数
function getExcept($nums, $smallest){
    $result = [];
    foreach($nums as $val){
        if($smallest % $val != 0){
            $result[] = $val;
        }
    }
    return $result;
}
//获取两个数的最小公倍数
function getMultiple($a, $b){
    if($a < $b){
        $c = $a;
        $a = $b;
        $b = $c;
    }
    for($i = 2; $i <= $b; $i++){
        if(($a * $i) % $b == 0){
            return $a * $i;
        }
    }
}
$smallestNow = 2520;
$arr = range(11, 20);
$tempArr = getExcept($arr, $smallestNow);
$tempArr[] = $smallestNow;
$a = current($tempArr);
$b = next($tempArr);
do{
    $a = getMultiple($a, $b);
}while($b = next($tempArr));
echo $a;
?>
