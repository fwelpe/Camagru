<?php
session_start();
if (!$_SESSION["user"])
	header("Location: login.php");

function email_validate($mailstr)
{
	return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $mailstr)) ? FALSE : TRUE;
}

function user_exists($nm)
{
	require("config/database.php");
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare("SELECT * FROM users WHERE name = :name");
	$q->bindParam(':name', $nm);
	$q->execute();
	$user_exists = $q->fetch();
	$pdo = null;
	return ($user_exists);
}

function form_validate()
{
	if (!$_POST)
		return "no POST";
	else if (!email_validate($_POST["email"]) || strlen($_POST["email"]) > 100)
		return "wrong mail";
	else if (strlen($_POST["name"]) > 32)
		return "username is too long. max 32 characters";
	else if ($_SESSION["user"] !== $_POST["name"] && user_exists($_POST["name"]))
		return "name already exists";
	else if ($_POST["psw"] !== $_POST["psw-repeat"])
		return "passwords don't match";
	else if (strlen($_POST["psw"]) < 8)
		return "password length is less than 8";
	else if (strlen($_POST["psw"]) > 70)
		return "password too long";
	return true;
}

$post_chk = form_validate();
if ($post_chk !== true)
	echo $post_chk;
else {
	require("config/database.php");
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare(
		"UPDATE users SET name = :n, email = :e, hash = :h WHERE name = :u"
	);
	$n = htmlentities($_POST["name"]);
	$e = htmlentities($_POST["email"]);
	$hashed_psw = hash('gost-crypto', $_POST["psw"]);
	$q->bindParam(':n', $n);
	$q->bindParam(':e', $e);
	$q->bindParam(':h', $hashed_psw);
	$q->bindParam(':u', $_SESSION["user"]);
	$result = $q->execute();
	$q = $pdo->prepare(
		"UPDATE pics SET user = :n WHERE user = :u"
	);
	$q->bindParam(':n', $n);
	$q->bindParam(':u', $_SESSION["user"]);
	$result = $q->execute() && $result;
	$pdo = null;
	if ($result) {
		$_SESSION["user"] = $n;
		echo "changed";
	}
	else
		echo "not changed";
}
?>
