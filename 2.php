<?php
$sum = 0;
function Fibonacci($n)
{
    if ($n < 2) return 1;
    return Fibonacci($n - 2) + Fibonacci($n - 1);
}
for ($i = 1; $i <= 100; $i++) {
    $num = Fibonacci($i);
    if ($num > 4000000) {
        break;
    }
    if ($num % 2 == 0) {
        $sum += $num;
    }
}
echo 'sum:' . $sum;

?>
