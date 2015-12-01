<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/11/30
 * Time: 16:37
 */
/**
 * https://projecteuler.net/problem=29
 * ����˼·��ָ����Χ�ڵ�ֵ����ָ���������ָ����Χ���������ظ����磺
 * 2^2ָ�����Ϊ4,10^2��ָ��Ϊ100����2��4��10��100��ָ�������������ظ�
 */
//�ɴ��ε�array_map
function local_array_map($array, $variable)
{
    $multi = function($item) use ($variable)
    {
        return $item * $variable;
    };
    return array_map($multi, $array);
}
$hasSqrt = [];
$relation = [];
for($i = 2; $i <= 10; $i++){
    for($j = 1; $j <= 6; $j++){
        $temp = pow($i, $j);
        if($temp <= 100){
            $hasSqrt[] = $temp;
            $relation[$i][$j] = $temp;
        }
    }
}
$array = range(2, 100); //����2-100��������2-100��ָ��
$hasSqrt = array_unique($hasSqrt);
$withoutSqrt = array_diff($array, $hasSqrt);
$withoutSqrtDistinct = count($withoutSqrt) * 99; //��ȡ��������ָͬ�����������ָ������

//4,8����2�Ľ���г��֣�9����3�Ľ���г��֣�����unset
unset($relation[4]);
unset($relation[8]);
unset($relation[9]);
foreach($relation as $root => $value){
    $tempArr = [];
    foreach($value as $exp => $power){
        $tempArr = array_merge($tempArr, local_array_map($array, $exp));
    }
    $unique = array_unique($tempArr);
    $result[$root] = count($unique);
}
$hasSqrtDistinct = array_sum($result);
$total = $withoutSqrtDistinct + $hasSqrtDistinct;
echo $total;

