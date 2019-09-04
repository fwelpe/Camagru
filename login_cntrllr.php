<?php
session_start();
require("config/database.php");
if ($_POST && $_POST["uname"]) {
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare("SELECT * FROM users WHERE name = :name");
	$q->bindParam(':name', $_POST["uname"]);
	$q->execute();
	$result = $q->fetch();
	$pdo = null;
	$hash = $result["hash"];
	$hash_in = hash('gost-crypto', $_POST["psw"]);
	if ($hash !== $hash_in)
		echo "wrong username or password";
	else if ($result["confirmed"] === "0")
		echo "account not activated";
	else if ($hash == $hash_in) {
		$_SESSION["user"] = $_POST["uname"];
		header("Location: index.php");
	}
}
?>
