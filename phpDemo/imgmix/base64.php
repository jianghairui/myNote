<?php
/**
 * Created by PhpStorm.
 * User: 凯拓
 * Date: 2018/2/5
 * Time: 17:06
 */
$img = 'avatar.jpg';

function base64EncodeImage ($image_file) {
    $base64_image = '';
    $image_info = getimagesize($image_file);
    $image_data = fread(fopen($image_file, 'r'), filesize($image_file));
    $base64_image = 'data:' . $image_info['mime'] . ';base64,' . chunk_split(base64_encode($image_data));
    return $base64_image;
}

$base64_img = base64EncodeImage($img);
echo $base64_img;
//echo '<img src="' . $base64_img . '" alt="">';
?>

