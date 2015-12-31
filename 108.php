<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/12/31
 * Time: 17:06
 */

$n = 10;
$result = [];
do {
    //$n++;
    $result[$n] = 0;
    $minX = $n + 1;
    for ($i = 2; $i > 1; $i++) {
        $x = $i * $n / ($i - 1);
        var_dump($i);
        var_dump($x);
        echo '<br>';
        if (is_int($x)) {
            $result[$n]++;
        }
        if ($x == $minX) {
            break;
        }
    }
    print_r($result);
    break;
    //exit;

} while(true);

//$n2 = 5;
$result2 = [];
for($a = 1; $a < 1000; $a++) {
    for($b = 1; $b < 1000; $b++) {
        if (($n * ($a + $b) / ($a * $b)) == 1) {
            $result2[$n][] = [$a, $b];
        }else{
            //echo $a . '__' . $b . '__' . $n * ($a + $b) / ($a * $b) . '<br>';
        }
    }
}
print_r($result2);
