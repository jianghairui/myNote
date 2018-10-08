<?php
//echo '<pre>';
//print_r($_FILES['file']);
//echo '</pre>';
//die;
date_default_timezone_set('PRC');
foreach ($_FILES as $k=>$v) {
    if($v['name'] == '') {
        unset($_FILES[$k]);
    }
}
if($_FILES) {
    echo 'YES';
}else {
    echo 'NO';
}
$file = 'name';
$allowType = array(
    "image/gif",
    "image/jpeg",
    "image/png",
    "image/pjpeg",
    "image/bmp"
);
p($_FILES[$file]);

//if(!in_array($_FILES[$file]["type"],$allowType)) {
//    die('invalid fileType');
//}
if($_FILES[$file]["size"] > 1024*512) {
    die('fileSize not exceeding  512Kb');
}

if ($_FILES[$file]["error"] > 0) {
    echo "Return Code: " . $_FILES[$file]["error"] . "<br />";
}else {
    $filename_array = explode('.',$_FILES[$file]['name']);
    $ext = array_pop($filename_array);

    $path =  './upload/' . date('Y-m-d');
    is_dir($path) or @mkdir($path,0777,true);
    //转移临时文件
    $newname = create_unique_number() . '.' . $ext;
    move_uploaded_file($_FILES[$file]["tmp_name"], $path . "/" . $newname);
}


function create_unique_number($letter = '')
{
    $time = explode (" ", microtime ());
    $timeArr = explode('.',$time [0]);
    $mtime = array_pop($timeArr);
    $fulltime = $letter.$time[1].$mtime;
    return $fulltime;
}

function p($arr) {
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}

?>