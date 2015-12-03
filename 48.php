<?php
// 比较两个大浮点数
function Compare($big, $small, $precision = 5)
{
    $e = pow(10, $precision);
    $ibig = intval($big / $e);
    $ismall = intval($small / $e);
    return ($ibig > $ismall);
}
$sum = 0;
$line = pow(10, 10);
for ($i = 1; $i < 1000; $i++) {
    if ($i % 10 == 0) {
        continue;
    }
    $temp = $i;
    for ($j = 1; $j < $i; $j++) {
        $temp = $temp * $i;
        if (Compare($temp, $line)) {
            $temp = substr($temp, -10); //获取倒数十位数字，使用取余方法失败
        }
    }
    $sum += $temp;
    if (Compare($sum, $line)) {
        $sum = substr($sum, -10);
    }
}
echo 'sum : ' . $sum;
//此题使用BCMath扩展可简化很多步骤
?>
