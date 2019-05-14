<?php

//连接,$error错误编号,$errstr错误的字符串,30s是连接超时时间

$fp=fsockopen("ssl://www.youku.com",443,$errno,$errstr,30);
if(!$fp) die("连接失败".$errstr);
//构造http协议字符串，因为socket编程是最底层的，它还没有使用http协议

$http="GET /?spm=a2ha1.12675304.m_6913_c_14318.d_7&scm=20140719.manual.6913.url_in_blank_http%3A%2F%2Fculture.youku.com HTTP/1.1\r\n";   //  \r\n表示前面的是一个命令

$http.="Host:www.youku.com\r\n";  //请求的主机

$http.="Connection:close\r\n\r\n";   // 连接关闭，最后一行要两个\r\n

//发送这个字符串到服务器

fwrite($fp,$http,strlen($http));

//接收服务器返回的数据

$data='';

while (!feof($fp)) {
    $data.=fread($fp,4096);  //fread读取返回的数据，一次读取4096字节
}
//关闭连接

fclose($fp);

var_dump(htmlentities($data,ENT_QUOTES,"UTF-8"));

?>