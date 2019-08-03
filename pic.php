<?php
$file = 'stickers/ex.png';
$type = 'image/png';
header('Content-Type: ' . $type);
header('Content-Length: ' . filesize($file));
readfile($file);
?>
