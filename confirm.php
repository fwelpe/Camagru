<?php
require("config/database.php");
if ($_GET && array_key_exists("uname", $_GET)) {
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare("UPDATE users SET confirmed = '1' WHERE name = :name");
	$q->bindParam(':name', $_GET["uname"]);
	$q->execute();
	$pdo = null;
	echo "confirmed";
}
?>
