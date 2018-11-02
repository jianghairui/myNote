<?php
include 'page.class.php';
header('Content-Type:text/html;charset=utf-8');
$p = new Page(990,10,5);
echo $p->fpage(4,5,6);
echo $p->fpage(7);






?>