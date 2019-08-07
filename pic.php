<?php
$json_recieved = json_decode(file_get_contents('php://input'), true);
$sticker_path = 'stickers/src/' . $json_recieved["sticker_id"];
// $mainpic = base64_decode(explode(',', $json_recieved["capturedURI"])[1]);
$mainpic = imagecreatefrompng($json_recieved["capturedURI"]);
$sticker = imagecreatefromwebp($sticker_path);
imagealphablending($mainpic, true);
imagesavealpha($mainpic, true);
// imagealphablending($sticker, false);
// imagesavealpha($sticker, true);
imagecopy($mainpic, imagescale($sticker, 200, 200), $json_recieved["width"] - 100, $json_recieved["height"] - 100, 0, 0, 200, 200);
header('Content-Type: image/png');
// error_log(substr($json_recieved["capturedURI"], 0, 35), 4); //dbg-INFO
// file_put_contents("tmp", $mainpic); //dbg-INFO
// echo $mainpic;
imagewebp($mainpic);
?>
