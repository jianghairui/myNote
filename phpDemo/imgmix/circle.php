<?php
header("Content-type: image/png");
$image = imagecreate( 200, 200 );
$red = imagecolorallocate($image, 255,0,0);
$blue = imagecolorallocate($image, 0,0,255 );
imagearc( $image, 99, 99, 180, 180, 0, 360, $blue );
imagefill( $image, 99, 99, $blue );
imagepng($image);
?>