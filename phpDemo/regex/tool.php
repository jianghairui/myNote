<?php

function is_username($username) {
    if (!preg_match("/^\w{6,20}$/", $username)) {
        return false;
    }
    return true;
}

function is_password($password) {
    if (!preg_match("/^\w{6,20}$/", $password)) {
        return false;
    }
    return true;
}

function is_email($email) {
    if(!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/',$email)) {
        return false;
    }
    return true;
}

function is_currency($str) {
    if(!preg_match('/^\d{1,8}(\.\d{1,2})?$/',$str)) {
        return false;
    }
    return true;
}

function is_tel($tel) {
    if(!preg_match('/13[123569]{1}\d{8}|15[1235689]\d{8}|188\d{8}/',$tel)) {
        return false;
    }
    return true;
}

function is_date($date, $formats = array("Y-m-d", "Y/m/d","Y-m-d H:i","Y-m-d H:i:s")) {
    $unixTime = strtotime($date);
    if (!$unixTime) { //strtotime转换不对，日期格式显然不对。
        return false;
    }
    //校验日期的有效性，只要满足其中一个格式就OK
    foreach ($formats as $format) {
        if (date($format, $unixTime) == $date) {
            return true;
        }
    }

    return false;
}

function input_limit($str,$limit_num,$char='utf8') {
    if(mb_strlen($str,$char) > $limit_num) {
        return false;
    }
    return true;
 }

function create_unique_number($letter = '')
{
    $time = explode (" ", microtime ());
    $timeArr = explode('.',$time [0]);
    $mtime = array_pop($timeArr);
    $fulltime = $letter.$time[1].$mtime;
    return $fulltime;
}

function p_makeOrderNum($firstMark='F') {
    $hSeconds = bcmul(substr(date('His'), 0, 2), 3600);
    $mSeconds = bcmul(substr(date('His'), 2, 2), 60);
    $sSeconds = substr(date('His'), 4, 2);
    $seconds = $hSeconds+$mSeconds+$sSeconds;
    $orderSn = $firstMark.substr(date('Ymd'), 2, 6).$seconds.rand(100001,999999);   //订单号
    return $orderSn;
}

$arr = array();
for($i=0;$i<10000;$i++) {
    $arr[] = create_unique_number('Q');
//    echo create_unique_number('Q') . '<br>';
}
echo count($arr) . '<br>';
echo count(array_unique($arr)) . '<br>';
