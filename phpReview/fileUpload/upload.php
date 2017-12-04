<?php
//echo '<pre>';
//print_r($_FILES['file']);
//echo '</pre>';
//die;
if ((($_FILES["file"]["type"] == "image/gif")
        || ($_FILES["file"]["type"] == "image/jpeg")
        || ($_FILES["file"]["type"] == "image/png")
        || ($_FILES["file"]["type"] == "image/pjpeg"))
    && ($_FILES["file"]["size"] < 800000000)) {

    if ($_FILES["file"]["error"] > 0) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }else {
        echo "Upload: " . $_FILES["file"]["name"] . "<br />";
        echo "Type: " . $_FILES["file"]["type"] . "<br />";
        echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
        echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
//转移临时文件
        if (file_exists("./upload/" . $_FILES["file"]["name"])) {
            echo $_FILES["file"]["name"] . " already exists. ";
        }else {
            move_uploaded_file($_FILES["file"]["tmp_name"],
                "./upload/" . $_FILES["file"]["name"]);
            echo "Stored in: " .dirname($_SERVER['REQUEST_URI']). "/upload/" . $_FILES["file"]["name"];
        }
    }
}else {
    echo "Invalid file";
}
?>