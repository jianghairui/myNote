<?php
$weigeti='W3CSchool 在线教程网：http://www.jb51.com，你Jbzj!了吗？';
// echo preg_replace('/.+(http\:[\w\-\/\.]+\/)[^\w\-\!]+([\w\-\!]+).+/','$1',$weigeti);
// echo preg_replace('/.+(http\:[\w\-\/\.]+\/)[^\w\-\!]+([\w\-\!]+).+/','\1',$weigeti);
// echo preg_replace('/.+(http\:[\w\-\/\.]+\/)[^\w\-\!]+([\w\-\!]+).+/','\\1',$weigeti);
// 上面三个都是输出 【http://www.jb51.net】
echo preg_replace('/^(.+)网：(http:\/\/\w+\.\w+\.com).+(J.+\!).+$/','栏目：$1<br>网址：$2<br>商标：$3',$weigeti);
/*
栏目：W3CSchool 在线教程
网址：http://www.jb51.net
商标：Jbzj!
*/
// 括号中括号，外面括号先计数

?>