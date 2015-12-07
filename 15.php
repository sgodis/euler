<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/27
 * Time: 14:46
 */

/**
 * 一开始使用递归的方法求解，但是递归计算需要占用巨大的空间和时间，个人PHP配置设置的时间内无法计算出20×20的结果，
 * 但是可以利用该方法求出任意n×m的grid可能的路径，当然，n和m不要太大
 */

/**
 * @param $latticePaths
 * @param $row
 * @param $col
 * @return mixed
 */
function getLatticePaths($latticePaths, $row, $col)
{
    if(!isset($latticePaths[$row])){
        $latticePaths[$row] = [];
    }
    if(isset($latticePaths[$row][$col]) && $latticePaths[$row][$col]){
        return $latticePaths[$row][$col];
    }else{
        $latticePaths[$row][$col] = 0;
    }
    if($col == 1){
        $latticePaths[$row][$col] = $row + 1;
        return $latticePaths[$row][$col];
    }
    if($row == $col){
        $latticePaths[$row][$col] = getLatticePaths($latticePaths, $row, $col - 1) * 2;
        return $latticePaths[$row][$col];
    }
    if($row > $col){
        for($i = $col; $i >= 1; $i--){
            $latticePaths[$row][$col] = bcadd($latticePaths[$row][$col], getLatticePaths($latticePaths, $row - 1, $i));
        }
        $latticePaths[$row][$col]++;
        return $latticePaths[$row][$col];
    }
}
$row = 5;
$col = 5;
$result = getLatticePaths([], $row, $col);
echo $result . '<br>';

/**
 * 发现无法利用上述方法求解后，就寻找每一次增加一层发生的变化
 * 通过图形路径的分析，可以发现：
 * 3×3：(1 + 3 + 6 ) × 2，
 * 4×4：(1 + 4 + 10 + 20 ) × 2，
 * 5×5：(1 + 5 + 15 + 35 + 70 ) × 2，
 * 6×6：(1 + 6 + 21 + 56 + 126 + 252) × 2，
 * 第一个位置都是1
 * 每一层的第n个位置的值都是上一层的第n-1个位置到第一个值的和
 * 最大值是上一层所有的值的和
 */

$array = [
    2   => [1, 3, 6], //此处数组从0开始，2即是3×3的元素，6即是2×2的结果
    3   => [1, 4, 10, 20],
    4   => [1, 5, 15, 35, 70],
];

$grid = 20;
for($i = 5; $i <= $grid; $i++){
    $tempSum = array_sum($array[$i - 1]);
    for($j = 1; $j <= $i; $j++){
        $array[$i][] = array_sum(array_slice($array[$i - 1], 0, $j)); //计算第0个位置到第$j个位置所有值的和
    }
    $array[$i][] = $tempSum * 2;//最后一个值是上一层结果的两倍
}
echo $array[$grid][$grid] . '<br>';
print_r($array);
