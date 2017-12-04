<?php
session_start();

require_once ("upload.class.php");
$progress = (new CUpload())->progress();
echo json_encode($progress);




?>