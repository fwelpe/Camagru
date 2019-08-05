<?php
$dir = 'stickers/src/';
$data = json_decode(file_get_contents('php://input'), true);
$file = $dir . $data["sticker_id"];
$type = 'image/webp';
header('Content-Type: ' . $type);
header('Content-Length: ' . filesize($file));
readfile($file);
?>
