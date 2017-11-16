<?php

session_start();
if(isset($_SESSION['views']))   {
    $_SESSION['views']=$_SESSION['views'] + 1;
}else {
    $_SESSION['views']=1;
}
echo "Views=". $_SESSION['views'];
//session_destroy();
//unset($_SESSION['views']);

/*
 * setcookie("user", "Alex Porter", time()+3600);
 * echo $_COOKIE['user'];
 *
 *
 * */

























?>