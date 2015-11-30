<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/27
 * Time: 14:46
 */
$result = 6;

for($i = 3; $i <= 20; $i++){
    $result = ($result * 2 + $i);
}
echo $result;