<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>Password reset</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
	<link rel='stylesheet' type='text/css' media='screen' href='css/w3.css'>
</head>

<body>
	<?php include("header2.html") ?>
	<?php if (!$_GET) { ?>
		<center><img src="kermit.png" width="400" /></center>
	<?php } else { ?>
		<form action="recover_cntrllr.php" method="POST" style="border:1px solid #ccc">
			<div class="container">
				<h1>Password reset</h1>
				<p>Please set your new password.</p>
				<hr>
				<label for="psw"><b>Password</b></label>
				<p>Password must be at least 8 characters long.</p>
				<input type="password" placeholder="Enter Password" name="psw" required>

				<label for="psw-repeat"><b>Repeat Password</b></label>
				<input type="password" placeholder="Repeat Password" name="psw-repeat" required>
				<input type="hidden" name="name" value="<?php echo $_GET["uname"] ?>">
				<input type="hidden" name="token" value="<?php echo $_GET["token"] ?>">
				<div class="clearfix">
					<button type="submit" class="signupbtn">OK</button>
				</div>
			</div>
		</form>
	<?php
	};
	include("footer.html");
	?>
</body>

</html>
