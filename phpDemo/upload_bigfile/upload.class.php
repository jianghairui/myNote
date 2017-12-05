<?php
date_default_timezone_set('PRC');
class CUpload
{
    const   UPLOAD_PROGRESS_PREFIX = 'progress_bar';
    private $_sUploadDir,  $_sProgressKey;


    public function __construct()
    {
        if ('' === session_id()) session_start();
        $this->_sUploadDir = 'uploads/';
        $this->_sProgressKey = strtolower(ini_get('session.upload_progress.prefix') . self::UPLOAD_PROGRESS_PREFIX);
    }

    public function addFile($filename)
    {
        if(!empty($_FILES[$filename])) {
            $error = $_FILES[$filename]['error'];
            $name = $_FILES[$filename]['name'];
            $size = $_FILES[$filename]['size'];
            $type = $_FILES[$filename]['type'];
            $tmp_name = $_FILES[$filename]['tmp_name'];

            if ($error > 0) {//判断上传错误信息
                switch ($error) {
                    case 1:
                        return "上传文件大小超出配置文件规定值";
                        break;
                    case 2:
                        return "上传文件大小超出表单中的约定值";
                        break;
                    case 3:
                        return "上传文件不全";
                        break;
                    case 4:
                        return "没有上传文件";
                        break;
                    default:
                        return "其他错误";
                }
            }
            if(($type == "image/gif") || ($type == "image/jpeg") || ($type == "image/png") || ($type == "image/pjpeg")) {
                if($size > 100*1024*1024) {
                    return '文件大小超过100M';
                }
                $arr = explode('.',$name);
                $ext = array_pop($arr);
                $new_name = time().'.'.$ext;
                move_uploaded_file($tmp_name, $this->_sUploadDir . $new_name);
                return '上传成功';

            }else {
                return '图片格式不符';
            }

        }else {
            return '没有上传文件';
        }

    }

    /**
     * @return 上传进度
     */
    public function progress()
    {
        if(!empty($_SESSION[$this->_sProgressKey])) {
            $aData = $_SESSION[$this->_sProgressKey];
            $iProcessed = $aData['bytes_processed'];
            $iLength    = $aData['content_length'];
            $iProgress  = ceil(100*$iProcessed / $iLength);
        }else {
            $iProgress = 100;
        }

        return $iProgress;
    }

//    public function cancel()
//    {
//        if (!empty($_SESSION[$this->_sProgressKey]))
//            $_SESSION[$this->_sProgressKey]['cancel_upload'] = true;
//        return $this;
//    }

//    public function __destruct()
//    {
//        if ('' !== session_id())
//        {
//            $_SESSION = array();
//            session_destroy();
//        }
//    }

}