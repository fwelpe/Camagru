<?php
session_start();
if (!array_key_exists("user", $_SESSION))
	header("Location: login.php");
if (array_key_exists("picname", $_GET)) {
	require("config/database.php");
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare("DELETE FROM pics WHERE picname = :p");
	$q->bindParam(':p', $_GET["picname"]);
	$result = $q->execute();
	if ($result = (is_writable($_GET["picname"]) && $result))
		$result = unlink($_GET["picname"]) && $result;
	echo $result ? "deleted" : "not deleted";
}
?>
