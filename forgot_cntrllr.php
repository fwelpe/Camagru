<?php
function send_recover($name, $email, $token) {
	require("config/site.php");
	$link = "http://" . $ADDR . "/recover.php?uname=" . $name . "&token=" . $token;
	$msg = "To reset your password, follow this link:\n" .$link;
	$msg .= "\nRecovery link expires in 1 hour.";
	$headers = "From: sendbot@camagru.com";
	return mail($email, "Password reset (Camagru)", $msg, $headers);
}

function user_email($nm) {
	require("config/database.php");
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare("SELECT email FROM users WHERE name = :name");
	$q->bindParam(':name', $nm);
	$q->execute();
	$email = $q->fetch()["email"];
	$pdo = null;
	return ($email);
}

if (!$_POST)
	echo "no POST";
else if (!$_POST["name"])
	echo "oops you just broke my site! very well done";
else if ($email = user_email($_POST["name"])) {
	require("config/database.php");
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare("UPDATE users SET token = :t, token_expires = NOW() + INTERVAL 1 HOUR WHERE name = :n");
	$token = openssl_random_pseudo_bytes(80);
	$token = bin2hex($token);
	$q->bindParam(':n', $_POST["name"]);
	$q->bindParam(':t', $token);
	$q->execute();
	$pdo = null;
	if (send_recover($_POST["name"], $email, $token))
		echo "email sent";
	else
		echo "email failed. internal server problem";
}
