<?php
session_start();
if (!array_key_exists("user", $_SESSION))
	header("Location: login.php");
$capturedURI = explode(',', file_get_contents('php://input'))[1];
$pic = base64_decode($capturedURI);
$randname = "pics/" . uniqid() . ".png";
$recorded = file_put_contents($randname, $pic);
if ($recorded) {
	require("config/database.php");
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare(
		"INSERT INTO pics (`picname`, `user`, `date`)
		VALUES (:p, :u, NOW());"
	);
	$q->bindParam(':p', $randname);
	$q->bindParam(':u', $_SESSION["user"]);
	$q->execute();
	$pdo = null;
}
