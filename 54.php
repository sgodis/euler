<?php
/**
 * Created by PhpStorm.
 * User: huangxr
 * date: 2015/12/20
 * Time: 9:30
 */

//此题即梭哈游戏

/**
 * 黑桃♠：spade、红心♥：heart、梅花♣：club、方块♦：diamond
 * 5H 5C 6S 7S KD 2C 3S 8S 8D TD
 * 红心5，梅花5，黑桃6，黑桃7，方块K，梅花2，黑桃3，黑桃8，方块8，方块10
 *
 * 牌组由高到低：
 * T~A同花顺
 * 同花顺
 * 四张
 * 三张+一对
 * 同花
 * 顺子
 * 三张
 * 两对
 * 一对
 * 单张比大小，A最大
 *
 * tip : 此处暂无花色比较
 */

class PokerHand
{
    protected $type = [
        'HighCard'         => 1,   //Highest value card.
        'OnePair'          => 2,   //Two cards of the same value.
        'TwoPairs'         => 3,   //Two different pairs.
        'ThreeKind'        => 4,   //Three cards of the same value.
        'Straight'         => 5,   //All cards are consecutive values.
        'Flush'            => 6,   //All cards of the same suit.
        'FullHouse'        => 7,   //Three of a kind and a pair.
        'FourKind'         => 8,   //Four cards of the same value.
        'StraightFlush'    => 9,   //All cards are consecutive values of same suit.
        'RoyalFlush'       => 10,  //Ten, Jack, Queen, King, Ace, in same suit.
    ];

    protected $order = ['2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, 'T' => 10, 'J' => 11, 'Q' => 12, 'K' => 13, 'A' => 14];
    protected $suit = ['S', 'H', 'C', 'D'];

    /**
     * 梭哈牌组比较
     * @param $pokerA example: $pokerA = ['5H', '5C', '6S', '7S', 'KD'];
     * @param $pokerB          $pokerB = ['2C', '3S', '8S', '8D', 'TD'];
     * @return bool TRUE表示A牌组大，FALSE表示B牌组大
     */
    public function showHand($pokerA, $pokerB)
    {
        foreach($pokerA as $val){
            $temp = str_split($val);
            $splitPokerA['value'][] = $this->order[$temp[0]];
            $splitPokerA['suit'][]  = $val[1];
        }
        foreach($pokerB as $val){
            $temp = str_split($val);
            $splitPokerB['value'][] = $this->order[$temp[0]];
            $splitPokerB['suit'][]  = $val[1];
        }
        $hasSameValueA = $this->_hasSameValue($splitPokerA);
        $hasSameValueB = $this->_hasSameValue($splitPokerB);
        if (is_array($hasSameValueA) || is_array($hasSameValueB)) { //存在两张或两张以上
            if (is_array($hasSameValueA) && is_array($hasSameValueB)) { //如果都存在至少两张
                $maxA = max($hasSameValueA);
                $maxB = max($hasSameValueB);
                //同数值的牌越多，牌组越大
                if ($maxA > $maxB){
                    return TRUE;
                } elseif ($maxA < $maxB) {
                    return FALSE;
                } else {
                    $valueA = array_search($maxA, $hasSameValueA); //牌的数值
                    $valueB = array_search($maxB, $hasSameValueB);
                    switch ($maxA) {
                        case 4:
                            if ($valueA > $valueB) {
                                return TRUE;
                            //} elseif ($valueA = $valueB) { //只有一副牌时，不存在FourKind且牌数值一样
                            //    $valueA1 = array_search(1, $hasSameValueA); //同时是FourKind，那张单张的数值
                            //    $valueB1 = array_search(1, $hasSameValueB);
                            //    if ($valueA1 > $valueB1) {
                            //        return TRUE;
                            //    } elseif ($valueA1 < $valueB1) {
                            //        return FALSE;
                            //    }
                            } else {
                                return FALSE;
                            }
                            break;
                        case 3:
                            if (count($hasSameValueA) == 2 && count($hasSameValueB) == 3){ //A 是 FullHouse,B 是 ThreeKind
                                return TRUE;
                            } else if (count($hasSameValueA) == 3 && count($hasSameValueB) == 2){ //A 是 ThreeKind,B 是 FullHouse
                                return FALSE;
                            } else { //同为ThreeKind或FullHouse
                                if ($valueA > $valueB) { //不存在同数值情况，只需比较ThreeKind牌的大小
                                    return TRUE;
                                } else {
                                    return FALSE;
                                }
                            }
                            break;
                        case 2:
                            $countA = count($hasSameValueA);
                            $countB = count($hasSameValueB);
                            if ($countA == 3 && $countB == 4){ //A 是 TwoPairs,B 是 OnePair
                                return TRUE;
                            } else if ($countA == 4 && $countB == 3){ //A 是 TwoPairs,B 是 OnePair
                                return FALSE;
                            } else {
                                if ($countA == 3) { //同为TwoPairs
                                    $pairsValuesA = array_keys($hasSameValueA, '2');
                                    $pairsValuesB = array_keys($hasSameValueB, '2');
                                    $singleA = array_search(1, $hasSameValueA);
                                    $singleB = array_search(1, $hasSameValueB);
                                    $cond1 = isset($hasSameValueB[$pairsValuesA[0]]) && $pairsValuesA[0] != $singleB;
                                    $cond2 = isset($hasSameValueB[$pairsValuesA[1]]) && $pairsValuesA[1] != $singleB;
                                    if ($cond1 && $cond2) { //TwoPairs的值都一样，比较单张
                                        if ($singleA > $singleB){
                                            return TRUE;
                                        } elseif ($singleA < $singleB){
                                            return FALSE;
                                        } else {
                                            echo sprintf("line : %d 牌组一样，pokerA : %s,pokerB : %s. \n", __LINE__, $pokerA, $pokerB);
                                        }
                                    } elseif ($cond1 || $cond2) { ////TwoPairs的值有一个Pair值不一样，比较TwoPairs总和谁大
                                        return array_sum($pairsValuesA) > array_sum($pairsValuesB) ? TRUE : FALSE;
                                    } else { //TwoPairs的值都不一样，比较出最大的Pair
                                        return max($pairsValuesA) > max($pairsValuesB) ? TRUE : FALSE;
                                    }

                                } else { //同为OnePair
                                    if ($valueA > $valueB){
                                        return TRUE;
                                    } elseif ($valueA < $valueB) {
                                        return FALSE;
                                    } else {
                                        //Pair数值一样比较单张
                                        rsort($splitPokerA['value']); //此处误用sort，导致结果与真实结果差1
                                        rsort($splitPokerB['value']);
                                        for ($i = 0; $i < 5; $i++) {
                                            if ($splitPokerA['value'][$i] != $splitPokerB['value'][$i] && ($splitPokerA['value'][$i] > $splitPokerB['value'][$i])) {
                                                return TRUE;
                                            } else {
                                                return FALSE;
                                            }
                                        }
                                        echo sprintf("line : %d 牌组一样，pokerA : %s,pokerB : %s. \n", __LINE__, $pokerA, $pokerB);
                                    }

                                }
                            }
                            break;
                        default:
                            echo '程序出错：' . __LINE__;
                            exit;
                    }
                }

            } else {
                if ($hasSameValueA) {
                    if (count($hasSameValueA) == 2) {
                        return TRUE;
                    } else {
                        if ($this->_isFlush($splitPokerB) || $this->_isStraight($splitPokerB, FALSE)) {
                            return FALSE;
                        } else {
                            return TRUE;
                        }
                    }
                } elseif ($hasSameValueB) {
                    if (count($hasSameValueB) == 2) {
                        return FALSE;
                    } else {
                        if ($this->_isFlush($splitPokerA) || $this->_isStraight($splitPokerA, FALSE)) {
                            return TRUE;
                        } else {
                            return FALSE;
                        }
                    }
                } else {
                    echo '程序出错：' . __LINE__;
                    exit;
                }
            }
        } else { //不存在Pair,ThreeKind or FourKind,则可能是顺子，同花或无组合，判断单张大小
            $isFlushA = $this->_isFlush($splitPokerA);
            $isFlushB = $this->_isFlush($splitPokerB);
            $isStraightA = $this->_isStraight($splitPokerA, FALSE);
            $isStraightB = $this->_isStraight($splitPokerB, FALSE);
            rsort($splitPokerA['value']);
            rsort($splitPokerB['value']);
            if ($isFlushA && $isFlushB || (!$isFlushA && !$isFlushB)){ //都是同花或者都不是同花
                if ($isStraightA && $isStraightB) { //都是顺子则比大小
                    if($splitPokerA['value'][0] > $splitPokerB['value'][0]) {
                        return TRUE;
                    } elseif ($splitPokerA['value'][0] < $splitPokerB['value'][0]) {
                        return FALSE;
                    } else {
                        echo sprintf("line : %d 牌组一样，pokerA : %s,pokerB : %s. \n", __LINE__, $pokerA, $pokerB);
                    }
                } elseif ($isStraightA || $isStraightB) { //有一个是顺子
                    return $isStraightA ? TRUE : FALSE;
                } else { //都不是顺子
                    //print_r($splitPokerA['value']);
                    //print_r($splitPokerB['value']);
                    for($i = 0; $i < 5; $i++) {
                        if ($splitPokerA['value'][$i] > $splitPokerB['value'][$i]) {
                            return TRUE;
                        } elseif ($splitPokerA['value'][$i] < $splitPokerB['value'][$i]) {
                            return FALSE;
                        }
                    }
                    echo sprintf("line : %d 牌组一样，pokerA : %s,pokerB : %s. \n", __LINE__, $pokerA, $pokerB);
                }
            } elseif ($isFlushA || $isFlushB) { //如果其中只有一个是同花
                return $isFlushA ? TRUE : FALSE;
            }
        }
    }

    /**
     * 判断是否存在2~4张同样的牌
     * @param $poker
     * @return array|bool
     */
    private function _hasSameValue($poker)
    {
        $countValues = array_count_values($poker['value']);
        if (max($countValues) > 1) {
            return $countValues;
        } else {
            return FALSE;
        }

    }

    /**
     * 判断同花
     * @param $poker
     * @return bool
     */
    private function _isFlush($poker)
    {
        if (count(array_flip($poker['suit'])) == 1){
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * 判断顺子
     * @param $poker
     * @param bool|FALSE $require 是否需要判断存在相同的牌
     * @return bool
     */
    private function _isStraight($poker, $require = TRUE)
    {
        if (max($poker['value']) - min($poker['value']) != 4) {
            return FALSE;
        } else {
            if ($require && $this->_hasSameValue($poker)) { //存在相同数值的牌也不是顺子
                return FALSE;
            } else {
                return TRUE;
            }
        }
    }

    /**
     * 发随机卡牌
     * @param int $number 一个卡组几张
     * @param int $person 需要几个卡组
     * @param int $group 几副牌
     * @return array
     */
    public function getPoker($number, $person, $group = 1)
    {
        $result = [];
        if ($number * $person > 52 * $group) {
            echo '参与人数过多，扑克牌数量不够';
        }

        foreach($this->order as $key => $digit){
            foreach($this->suit as $color){
                $poker[] = $key . $color;
            }
        }
        $isShuffle = shuffle($poker);

        if ($isShuffle) {
            for ($i = 1; $i <= $person; $i++) {
                $result[] = array_slice($poker, rand(1, (52 - $i * $number)), $number);
            }
        }
        return $result;
    }

}

$obj = new PokerHand();
//$poker = $obj->getPoker(5, 2);
//读取扑克牌文件
$res = ['A' => 0, 'B' => 0];
$handle = fopen('p054_poker.txt', 'r');
if ($handle) {
    while (($buffer = fgets($handle)) !== false) {
        $allPoker = explode(' ', $buffer);
        $chunk = array_chunk($allPoker, 5);
        $pokerA = $chunk[0];
        $pokerB = $chunk[1];
        $obj->showHand($pokerA, $pokerB) ? $res['A']++ : $res['B']++;
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
}
print_r($res);
