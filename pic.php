<?php
$json_recieved = json_decode(file_get_contents('php://input'), true);
$sticker_path = 'stickers/src/' . $json_recieved["sticker_id"];
$decoded_mainpic = base64_decode(explode(',', $json_recieved["capturedURI"])[1]);
header('Content-Type: image/png');
// error_log(substr($json_recieved["capturedURI"], 0, 35), 4); //dbg-INFO
// file_put_contents("tmp", $decoded_mainpic); //dbg-INFO
echo $decoded_mainpic;
?>
