<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/27
 * Time: 9:51
 */
//我的方法
echo array_sum(str_split(bcpow(2, 1000), 1));

echo '=======华丽丽的分割线=======';
//答案中大神的php代码，不借助BC扩展，另辟蹊径
$sum = array(2);
for ($i=2; $i <= 1000; $i++) {
    $sum = duplicate($sum);
}
$tot = 0;
foreach ($sum as $key => $value) {
    $tot +=$value;
}
echo $tot;
function duplicate($array){
    for ($key=0; $key<count($array);$key++) {
        $array[$key] *=2;
        if($array[$key] > 9){
            if(!$key) {
                array_unshift($array,1);
                $array[$key+1] -=10;
                $key++;
            }else{
                $array[$key] -= 10;
                $array[$key-1] ++;
            }

        }
    }
    return $array;
}
