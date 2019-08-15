<?php
session_start();
if ($_POST["login"]) {
	$_SESSION["user"] = $_POST["login"];
	header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8'>
	<title>Camagru: Login</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
	<link rel='stylesheet' type='text/css' media='screen' href='css/w3.css'>
</head>

<body>
	<?php include("header.html") ?>
	<form method="POST" action="#">
		<input type="text" name="login" value="" placeholder="Username" />
		<br />
		<input type="password" name="passwd" value="" placeholder="Password" />
		<br />
		<input type="submit" name="submit" value="OK" />
	</form>

</body>

</html>
