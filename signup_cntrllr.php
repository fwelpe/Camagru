<?php
function email_validate($mailstr)
{
	return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $mailstr)) ? FALSE : TRUE;
}

function user_validate() {
	require("config/database.php");
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare("SELECT * FROM users WHERE name = :name");
	$q->bindParam(':name', $_POST["name"]);
	$q->execute();
	$result = $q->fetch();
	$pdo = null;
	return (!$result);
}

function form_validate()
{
	if (!$_POST)
		return "no POST";
	else if (!email_validate($_POST["email"]))
		return "wrong mail";
	else if (strlen($_POST["name"]) > 32)
		return "username is too long. max 32 characters";
	else if (!user_validate())
		return "name already exists";
	else if ($_POST["psw"] !== $_POST["psw-repeat"])
		return "passwords don't match";
	else if (strlen($_POST["psw"]) < 8)
		return "password length is less than 8";
	return true;
}

function send_confirm($name, $email) {
	require("config/site.php");
	$conf_link = "http://" . $ADDR . "/confirm.php?uname=" . $name;
	$msg = "Please, confirm your account, using this link: " .$conf_link;
	return mail($email, "Confirmation link (Camagru)", $msg);
}

$post_chk = form_validate();
if ($post_chk !== true)
	echo $post_chk;
else {
	require("config/database.php");
	$hashed_psw = hash('gost-crypto', $_POST["psw"]);
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare(
		"INSERT INTO users (`name`, `email`, `hash`)
		VALUES (:n, :e, :h);");
	$q->bindParam(':n', $_POST["name"]);
	$q->bindParam(':e', $_POST["email"]);
	$q->bindParam(':h', $hashed_psw);
	$q->execute();
	$pdo = null;
	if (send_confirm($_POST["name"], $_POST["email"]))
		echo "registered. check your mail";
	else
		echo "email failed. internal server problem";
}
