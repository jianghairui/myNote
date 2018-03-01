<?php
/*
    r 	打开文件为只读。文件指针在文件的开头开始。
    w 	打开文件为只写。删除文件的内容或创建一个新的文件，如果它不存在。文件指针在文件的开头开始。
    a 	打开文件为只写。文件中的现有数据会被保留。文件指针在文件结尾开始。创建新的文件，如果文件不存在。
    x 	创建新文件为只写。返回 FALSE 和错误，如果文件已存在。
    r+ 	打开文件为读/写、文件指针在文件开头开始。
    w+ 	打开文件为读/写。删除文件内容或创建新文件，如果它不存在。文件指针在文件开头开始。
    a+ 	打开文件为读/写。文件中已有的数据会被保留。文件指针在文件结尾开始。创建新文件，如果它不存在。
    x+ 	创建新文件为读/写。返回 FALSE 和错误，如果文件已存在。

//echo '<hr>';
//echo fgets($myfile);//输出首行,指针下移
//while(!feof($myfile)) {
//        echo fgets($myfile) . "<br>";
//}
feof() 函数检查是否已到达 "end-of-file" (EOF)。
feof() 对于遍历未知长度的数据很有用。
fgetc()输出单字符,指针后移
fread($filename,'')
$str = fread($myfile,filesize("system.php"))."\n";//输出全部内容
*/

header('Content-Type:text/html;charset=utf-8');
/*
$array = include("system.php");
$array['PER_PAGE'] = '35';
$str = '';
foreach($array as $k=>$v) {
    $str.= "'".$k."' => '".$v."',\n";
}
$newfile = fopen("system.php", "w") or die("Unable to open file!");
fwrite($newfile,"<?php\n return array(\n");
fwrite($newfile, $str);
fwrite($newfile, ");\n?>");

fclose($newfile);
*/

$array = include("system.php");
$data = array('HOME'=>'天津2');
$newArr = array_merge($array,$data);
$content = "<?php \n\r return ".var_export($newArr,true).";\n?>";
file_put_contents("system.php",$content);




















?>