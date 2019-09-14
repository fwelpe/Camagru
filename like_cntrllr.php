<?php
$content = trim(file_get_contents("php://input"));
$decoded = json_decode($content, true);
require("config/database.php");
$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare("SELECT * FROM likes WHERE picname = :p");
$q->bindParam(':p', $decoded["picname"]);
$q->execute();
$l = 0;
$d = 0;
while ($result = $q->fetch()) {
	$result["type"] === "0" ? $d += 1 : $l += 1;
}
$pdo = null;
$array = array("likes" => $l, "dislikes" => $d);
echo json_encode($array);
?>
