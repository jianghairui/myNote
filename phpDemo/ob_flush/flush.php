<?php

ob_imp_flush();


function ob_imp_flush() {
    ob_implicit_flush(true);

    echo str_pad(" ", 256);

    for ($i=100; $i>0; $i--) {
        echo $i, '<br />';
        ob_flush();
        usleep(100000);
    }
}
