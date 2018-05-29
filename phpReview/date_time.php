<?php
$time1 = strtotime('2016-02-04'); // 自动为00:00:00 时分秒
$time2 = strtotime('2018-05-28');
$monarr = array();
$monarr[] = date('Y-m',$time1); // 当前月;
while( ($time1 = strtotime('+1 month', $time1)) <= $time2){
    $monarr[] = date('Y-m',$time1); // 取得递增月;
}
?>