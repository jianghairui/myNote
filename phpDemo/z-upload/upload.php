<?php
if (!empty($_FILES['myfile'])) {//判断上传内容是否为空
    if ($_FILES['myfile']['error'] > 0) {//判断上传错误信息
        echo "上传错误：";
        switch ($_FILES['myfile']['error']) {
            case 1:
                echo "上传文件大小超出配置文件规定值";
                break;
            case 2:
                echo "上传文件大小超出表单中的约定值";
                break;
            case 3:
                echo "上传文件不全";
                break;
            case 4:
                echo "没有上传文件";
                break;
        }
    } else {
        list($maintype, $subtype) = explode("/", $_FILES['myfile']['type']);
        if (/*$maintype != "image" || $subtype != "png"*/false) {//如果要限制文件格式，就去掉注释
            echo "上传文件格式不正确";
        } else {
            if (!is_dir("./uploads")) {//判断指定目录是否存在
                mkdir("./uploads");//创建目录
            }
            $path = './uploads/' . time() . strtolower(strstr($_FILES['myfile']['name'], "."));//定义上传文件名和存储位置
            if (is_uploaded_file($_FILES['myfile']['tmp_name'])) {//判断文件上传是否为HTTP POST上传
                if (!move_uploaded_file($_FILES['myfile']['tmp_name'],$path)) {//执行上传操作
                    echo "上传失败";
                } else {
                    echo "文件:" . time() . strtolower(strstr($_FILES['myfile']['name'], ".")) . "上传成功，大小为：" . $_FILES['myfile']['size'] . "字节";
                }
            } else {
                echo "上传文件：".$_FILES['myfile']['name']."不合法";
            }
        }
    }
}