<?php
require 'smtp.php';
date_default_timezone_set('PRC');
$mailto='1873645345@qq.com';
$mailsubject="测试邮件";
$mailbody='这里是邮件内容';
$smtpserver     = "smtp.mxhichina.com";
$smtpserverport = 25;
$smtpusermail   = "boss@jianghairui.com";
$smtpuser       = "boss@jianghairui.com";
$smtppass       = "Boss22513822";
$mailsubject    = "=?UTF-8?B?" . base64_encode($mailsubject) . "?=";
$mailtype       = "HTML";
$smtp           = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
$smtp->debug    = true;
$smtp->sendmail($mailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
?>