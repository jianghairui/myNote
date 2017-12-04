<?php
date_default_timezone_set('PRC');
class CUpload
{
    const   UPLOAD_PROGRESS_PREFIX = 'progress_bar';
    private $file, $_sUploadDir,  $_sProgressKey;


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

            $arr = explode('.',$name);
            $ext = array_pop($arr);
            $new_name = time().'.'.$ext;
            move_uploaded_file($tmp_name, $this->_sUploadDir . $new_name);

            return '上传成功';
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