<?php
$json_recieved = json_decode(file_get_contents('php://input'), true);
$capturedURI = explode(',', $json_recieved["capturedURI"])[1];
$mainpic = imagecreatefromstring(base64_decode($capturedURI));
$mainpic = imagescale($mainpic, 500, 500);
$sticker_path = 'stickers/src/' . $json_recieved["sticker_id"];
if ($json_recieved["sticker_id"]) {
	$stic_size = 200;
	$sticker = imagecreatefromwebp($sticker_path);
	$sticker = imagescale($sticker, $stic_size, $stic_size);
	imagealphablending($mainpic, true);
	imagesavealpha($mainpic, true);
	imagecopy($mainpic, $sticker, $json_recieved["width"] - $stic_size / 2,
	$json_recieved["height"] - $stic_size / 2, 0, 0, $stic_size, $stic_size);
}
header('Content-Type: image/png');
// error_log(substr($json_recieved["capturedURI"], 0, 35), 4); //dbg-INFO
imagepng($mainpic);
