<?php
require_once("config/setup.php");
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
	<?php include("header2.html") ?>
	<form action="login_cntrllr.php" method="POST">
		<div class="container">
			<label for="uname"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="uname" required>

			<label for="psw"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="psw" required>

			<button type="submit">Login</button>
		</div>
		<div class="container" style="background-color:#f1f1f1">
			<button type="reset" class="cancelbtn">Cancel</button>
			<span class="psw">Forgot <a href="forgot.php">password?</a></span>
		</div>
	</form>
</body>

</html>
