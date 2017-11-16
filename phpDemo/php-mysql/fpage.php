<?php
header('Content-Type:text/html;charset=utf-8');
include "page.class.php";

$p = new Page(95,10,5);

echo $p->fpage();


?>