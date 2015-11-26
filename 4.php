<?php
function maxPalindromeNumber($a, $b)
{
    $result = [];
    for($i = $a; $i <= $b; $i++){
        for($j = $a; $j <= $b; $j++){
            $res = $i * $j;
            if ($res == strrev($res)) {
                $result[] = $res;
            }
        }
    }
    if($result){
        return max($result);
    }else{
        return '该区间不存在回文数';
    }
}
echo maxPalindromeNumber(900, 999);
?>
