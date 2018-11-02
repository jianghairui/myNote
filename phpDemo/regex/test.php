<?php
header('Content-Type:text/html; charset=utf-8');
function MakeCard() {
    set_time_limit(0);
    //处理缓冲区
    ob_end_clean();
    ob_implicit_flush(true);
    echo str_pad(" ", 256);
    //数量,点数,批号
    $num=100;
    $point=1;
    $batch=1;
    $ym=date('ym');
    $num=$num*100;
    //卡的张数，即记录数
    echo "<p>开始 ".date("H:i:s")." <br>";
    for($i=1;$i<=$num;$i++) {
        $sn=sprintf("%02s%s%06s",$batch,$ym,$i); $seek=mt_rand(0,9999).mt_rand(0,9999).mt_rand(0,9999);//12位
        $start=mt_rand(0,20); $str=strtoupper(substr(md5($seek),$start,12));
        $str=str_replace("O",chr(mt_rand(65,78)),$str); $str=str_replace("0",chr(mt_rand(65,78)),$str);
        $row=array('sn'=>$sn,'password'=>$str,'created'=>time(),'point'=>$point);
        //查重 //在这里加插入数据的代码.
        print_r($row);echo '<br>';
    }
    echo " 结束 ".date("H:i:s")."";
    printf("<br>成功生成：%s万个 %s点 的密码</p>",$num/1e4,$point); return $num;
}
//函数结束

//$_POST['num']=1; $_POST['point']=10; $_POST['batch']=10;
//$_POST['ym']='1405';


echo MakeCard();



?>