<?php
function token_work($sqltime)
{
	return (strtotime($sqltime) > time());
}


if (
	$_POST && array_key_exists("name", $_POST) && array_key_exists("token", $_POST) &&
	array_key_exists("psw", $_POST) && array_key_exists("psw-repeat", $_POST)
) {
	require("config/database.php");
	if ($_POST["psw"] !== $_POST["psw-repeat"])
		echo "passwords dont match";
	else if (strlen($_POST["psw"]) < 8)
		echo "password too short";
	else {
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$q = $pdo->prepare("SELECT * FROM users WHERE name = :name");
		$q->bindParam(':name', $_POST["name"]);
		$q->execute();
		$result = $q->fetch();
		$pdo = null;
		if ($result && $result["token"] === $_POST["token"]) {
			if (!token_work($result["token_expires"])) {
				echo "link expired";
			} else {
				$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$q = $pdo->prepare("UPDATE users SET hash = :p, token = NULL WHERE name = :n");
				$q->bindParam(':n', $_POST["name"]);
				$new_psw = hash("gost-crypto", $_POST["psw"]);
				$q->bindParam(':p', $new_psw);
				$q->execute();
				$pdo = null;
				echo "password changed";
			}
		}
	}
}
