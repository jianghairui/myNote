<?php
/**
 * Created by PhpStorm.
 * User: JHR
 * Date: 2019/6/26
 * Time: 21:48
 */



    $_body = file_get_contents('php://input');
    $body = json_decode($_body, true);
    $this->qiniulog($this->cmd,var_export($body,true));

    header('Content-Type: application/json');

    $resp = array('ret' => 'success');

    echo json_encode($resp);

