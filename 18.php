<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/12/1
 * Time: 13:44
 */

/*
 * 如何与下一节点值相加
 */
$triangleStr = <<<EOT
75
95 64
17 47 82
18 35 87 10
20 04 82 47 65
19 01 23 75 03 34
88 02 77 73 07 63 67
99 65 04 28 06 16 70 92
41 41 26 56 83 40 80 70 33
41 48 72 33 47 32 37 16 94 29
53 71 44 65 25 43 91 52 97 51 14
70 11 33 28 77 73 17 78 39 68 17 57
91 71 52 38 17 14 91 43 58 50 27 29 48
63 66 04 68 89 53 67 30 73 16 69 87 40 31
04 62 98 27 23 09 70 98 73 93 38 53 60 04 23
EOT;
$triangleArr = explode("\r\n", $triangleStr);
foreach($triangleArr as &$val){
    $val = explode(" ", $val);
}
$reTriangleArr = array_reverse($triangleArr);
for ($row = 0; $row < 15; $row++) {
    $result[] = comparePath(0, $row);
}
echo max($result);
for ($col = 0; $col < 15; $col++) {
    $maxPathSum[$col] = [];
}

function comparePath($col, $row)
{
    global $reTriangleArr;
    global $maxPathSum;
    if ($col == 14){
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


