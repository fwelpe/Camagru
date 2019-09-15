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

function get_username($picname) {
	require("config/database.php");
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare("SELECT user FROM pics WHERE picname = :p");
	$q->bindParam(':p', $picname);
	return ($q->execute()["user"]);
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
	$q = $pdo->prepare("SELECT * FROM users WHERE name = :n");
	$commented_user = get_username($_POST["pic"]);
	$q->bindParam(':n', $commented_user);
	$commented_user_dbrow = $q->execute();
	if ($commented_user_dbrow["notify"]) {
		require("config/site.php");
		$link = "http://" . $ADDR . "/image.php?pic=" . $_POST["pic"];
		$msg = "See your post:\r\n" . PHP_EOL;
		$msg .= $link;
		$headers = "From: sendbot@camagru.com";
		$result = mail($commented_user_dbrow["email"], "You have new comment! (Camagru)", $msg, $headers) && $result;
	}
	$pdo = null;
	if ($result)
		echo "commented";
}
