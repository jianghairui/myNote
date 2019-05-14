<?php
// 定义卡牌数组，调用get_rand返回指定卡牌
function get_rand_card()
{
    $prize_arr = [
        ['id' => 1, 'probability' => 200],
//            ['id' => 1, 'probability' => 1],
        ['id' => 2, 'probability' => 150],
        ['id' => 3, 'probability' => 100],
        ['id' => 4, 'probability' => 150],
        ['id' => 5, 'probability' => 1],
//            ['id' => 5, 'probability' => 200],
        ['id' => 6, 'probability' => 199],
        ['id' => 7, 'probability' => 50],
        ['id' => 8, 'probability' => 50],
        ['id' => 9, 'probability' => 100]
    ];

    foreach ($prize_arr as $key => $val) {
        $arr[$val['id']] = $val['probability'];
    }

    return get_rand($arr);
}

// 根据卡牌数组返回指定卡牌
function get_rand($proArr)
{
    $result = '';
    //概率数组的总概率精度
    $proSum = array_sum($proArr);
    //概率数组循环
    foreach ($proArr as $key => $proCur) {
        $randNum = mt_rand(1, $proSum);
        if ($randNum <= $proCur) {
            $result = $key;
            break;
        } else {
            $proSum -= $proCur;
        }
    }
    unset ($proArr);
    return $result;
}

echo '<pre>';
print_r(get_rand_card());
echo '</pre>';