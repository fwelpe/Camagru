<?php
$json_recieved = json_decode(file_get_contents('php://input'), true);
// $mainpic = imagecreatefrompng($json_recieved["capturedURI"]);
$mainpic = imagecreatefromstring(base64_decode(explode(',', $json_recieved["capturedURI"])[1]));
$sticker_path = 'stickers/src/' . $json_recieved["sticker_id"];
if ($json_recieved["sticker_id"]) {
	$sticker = imagecreatefromwebp($sticker_path);
	$sticker = imagescale($sticker, 200, 200);
	imagealphablending($mainpic, true);
	imagesavealpha($mainpic, true);
	imagecopy($mainpic, $sticker, $json_recieved["width"] - 100, $json_recieved["height"] - 100, 0, 0, 200, 200);
}
header('Content-Type: image/png');
// error_log(substr($json_recieved["capturedURI"], 0, 35), 4); //dbg-INFO
// file_put_contents("tmp.png", $mainpic); //dbg-INFO
// echo $mainpic_bin;
imagepng($mainpic);
