<?php
//echo $_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'];这句等于__FILE__

echo __FILE__.'<br>';//绝对路径目录及文件名		D:\phpStudy\WWW\NameSpace\__dir__.php

echo __DIR__.'<br>';//绝对路径目录   			D:\phpStudy\WWW\NameSpace


echo $_SERVER['SCRIPT_FILENAME'].'<br>';//		D:/phpStudy/WWW/NameSpace/__dir__.php


echo $_SERVER['DOCUMENT_ROOT'].'<br>';//   		D:/phpStudy/WWW

echo $_SERVER['PHP_SELF'].'<br>';//   			/NameSpace/__dir__.php

?>