<?php
$source_jpg = 'sheikh-photo.jpg';
$destination_webp = 'sheikh-photo.webp';
if (file_exists($source_jpg)) {
    $im = imagecreatefromjpeg($source_jpg);
    if ($im) {
        imagewebp($im, $destination_webp, 80);
        imagedestroy($im);
        echo "sheikh-photo converted.\n";
    }
}

$source_png = 'name.png';
$destination_png_webp = 'name.webp';
if (file_exists($source_png)) {
    $im2 = imagecreatefrompng($source_png);
    if ($im2) {
        imagepalettetotruecolor($im2);
        imagealphablending($im2, true);
        imagesavealpha($im2, true);
        imagewebp($im2, $destination_png_webp, 80);
        imagedestroy($im2);
        echo "name.png converted.\n";
    }
}
