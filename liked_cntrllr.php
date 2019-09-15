<?php
session_start();
if (!$_SESSION)
	header("Location: login.php");
else if (!$_SESSION["user"])
	header("Location: login.php");
else {
	$content = trim(file_get_contents("php://input"));
	$decoded = json_decode($content, true);
	require("config/database.php");
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare("DELETE FROM likes WHERE user = :u AND picname = :p");
	$q->bindParam(':u', $_SESSION["user"]);
	$q->bindParam(':p', $decoded["picname"]);
	$q->execute();
	$q = $pdo->prepare(
		"INSERT INTO likes (`picname`, `user`, `type`)
	VALUES (:p, :u, :t);"
	);
	$q->bindParam(':p', $decoded["picname"]);
	$q->bindParam(':u', $_SESSION["user"]);
	$q->bindParam(':t', $decoded["type"]);
	$q->execute();
	$pdo = null;
}
?>
