<?php
session_start();

function prereq()
{
	if (!$_SESSION["user"])
		return false;
	else if (!$_POST["comment"])
		return false;
	else if (strlen($_POST["comment"]) > 5000) {
		echo "too long (>5000 letters) comment";
		return false;
	}
	return true;
}

if (prereq()) {
	require("config/database.php");
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare(
		"INSERT INTO comments (`picname`, `user`, `date`, `comment`)
		VALUES (:p, :u, NOW(), :c);"
	);
	$c = htmlentities($_POST["comment"]);
	$q->bindParam(':p', $_POST["pic"]);
	$q->bindParam(':u', $_SESSION["user"]);
	$q->bindParam(':c', $c);
	$result = $q->execute();
	$q = $pdo->prepare("SELECT notify FROM users WHERE name = :n");
	$q->bindParam(':n', $_SESSION["user"]);
	if ($q->execute()["notify"]) {
		require("config/site.php");
		$link = "http://" . $ADDR . "/image.php?pic=" . $_POST["pic"];
		$msg = $link;
		$headers = "From: sendbot@camagru.com";
		mail($email, "You have new comment! (Camagru)", $msg, $headers);
	}
	$pdo = null;
	if ($result)
		echo "commented";
}
