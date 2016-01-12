<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2016/1/11
 * Time: 20:12
 */
//自顶向下计算

$str = file_get_contents('p067_triangle.txt');
foreach(explode("\n",$str) as $row){
    $data[] = explode(" ", $row);
}
array_pop($data); //最后一个值为空
$col = count($data);
for ($j = 0; $j < $col; $j++){
    for ($i = 0; $i <= $j; $i++){
        $left = $right = 0;
        if (isset($data[$j-1][$i-1])){
            $left = $data[$j-1][$i-1];
        }
        if (isset($data[$j-1][$i])){
            $right = $data[$j-1][$i];
        }
        $data[$j][$i] = max($left, $right) + $data[$j][$i];
    }
}

echo max($data[$col - 1])."\n";

//自底向上计算

$triangleStr = file_get_contents('p067_triangle.txt');
$triangleArr = explode("\n", $triangleStr);
array_pop($triangleArr); //最后一个值为空
foreach($triangleArr as &$val){
    $val = explode(" ", $val);
}
$reTriangleArr = array_reverse($triangleArr);
$maxRow = count(current($reTriangleArr));
for ($row = 0; $row < $maxRow; $row++) {
    $result[] = comparePath(0, $row);
}
echo max($result);
for ($col = 0; $col < $maxRow; $col++) {
    $maxPathSum[$col] = [];
}

function comparePath($col, $row)
{
    global $reTriangleArr;
    global $maxPathSum;
    global $maxRow;
    if ($col == $maxRow - 1){
        $maxPathSum[$col][$row] = $reTriangleArr[$col][$row];
    } else {
        if ($row == 0) {
            if (!isset($maxPathSum[$col + 1][$row])) {
                $maxPathSum[$col + 1][$row] = comparePath($col + 1, $row);
            }
            $maxPathSum[$col][$row] = $reTriangleArr[$col][$row] + $maxPathSum[$col + 1][$row];
        } else if ($row == count($reTriangleArr[$col]) - 1) {
            if (!isset($maxPathSum[$col + 1][$row - 1])) {
                $maxPathSum[$col + 1][$row - 1] = comparePath($col + 1, $row - 1);
            }
            if (!isset($reTriangleArr[$col][$row])) {
                echo $col . '===' . $row;
            }
            $maxPathSum[$col][$row] = $reTriangleArr[$col][$row] + $maxPathSum[$col + 1][$row - 1];
        } else {
            if (!isset($maxPathSum[$col + 1][$row])) {
                $maxPathSum[$col + 1][$row] = comparePath($col + 1, $row);
            }
            if (!isset($maxPathSum[$col + 1][$row - 1])) {
                $maxPathSum[$col + 1][$row - 1] = comparePath($col + 1, $row - 1);
            }
            if ($maxPathSum[$col + 1][$row] >= $maxPathSum[$col + 1][$row - 1]) {
                $maxPathSum[$col][$row] = $reTriangleArr[$col][$row] + $maxPathSum[$col + 1][$row];
            } else {
                $maxPathSum[$col][$row] = $reTriangleArr[$col][$row] + $maxPathSum[$col + 1][$row - 1];
            }
        }
    }
    return $maxPathSum[$col][$row];
}

