<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2017/11/16
 * Time: 9:16
 */
header('Content-Type:text/html;charset=utf-8');
/*正则表达式 - 原子
1.普通字符原子,如:'/5/','/php/'
2.特殊字符作为原子,需要用反斜杠转义,如:'/\./'.'/\<br\/\>/'
3.非打印字符作位原子,如
\cx 等于 Control-[A-Za-z]
\f  换页符
\n  换行符
\r  回车符
\t  制表符
\v  垂直制表符
'/\r\n/'    Linux中匹配回车换行
'/\n/'      Windows 中匹配回车换行

4.通用字符型原子
\d  等于 [0-9]
\D  等于 [^0-9]
\s  等于 [\f\n\r\t\v]
\S  等于 [^\f\n\r\t\v]
\w  等于 [0-9a-zA-Z]
\W  等于 [^0-9a-zA-Z]

'/^\w+@\w+(\.\w+){0,3}$/' 匹配邮箱的正则表达式
5.自定义原子表[]
'/[apj]sp/'


*/

$rule1 = '/[apj]sp/';
$rule2 = '/^(very )*good$/';

$str1 = '我们学习了php和asp还有jsp,psp';
$str2 = 'very very good';


/*
 * 元字符*+?.|{n,m}^$\b\B[][^]()
 *
 * */
$rule3 = '/\d{4}(\W)\d{2}\\1\d{2}/';
$str3 = '2017-11-16是一个重要的日子';

$rule4 = '/\<b\>.*?\<\/b\>/';
$str4 = '<b>这是一行加  粗的字体</b>';


/*
 * 模式修正符
 * i    不区分大小写
 * m    把字符串视为多行,(^$)对每一行都生效
 * s    使.可匹配任意字符(包括换行符)
 * X    忽略空白
 * e
 * U
 * D
 * */

$rule5 = '/Gentleman$/i';
$str5 = 'Ladys And gentleman';

$result = preg_match($rule4,$str4,$matches);

if($result) {
    p($matches);
    echo '匹配';
}else {
    echo '不匹配';
}


/*------定界符/和#的区别-----*/

$regex = '/^http:\/\/([\w.]+)\/([\w]+)\/([\w]+)\.html$/i';
$str = 'http://www.youku.com/show_page/id_ABCDEFG.html';
$matches = array();
if(preg_match($regex, $str, $matches)){
    var_dump($matches);
}else {
    echo 'doesnt match';
}

echo "<br>";

$regex = '#^http://([\w.]+)/([\w]+)/([\w]+)\.html$#i';
$str = 'http://www.youku.com/show_page/id_ABCDEFG.html';
$matches = array();
if(preg_match($regex, $str, $matches)){
    var_dump($matches);
}
echo "<br>";






















function p($array) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}