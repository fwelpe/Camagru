<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>Sign Up</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
	<link rel='stylesheet' type='text/css' media='screen' href='css/w3.css'>
</head>

<body>
	<?php include("header2.html") ?>
	<form action="signup_cntrllr.php" method="POST" style="border:1px solid #ccc">
		<div class="container">
			<h1>Register</h1>
			<p>Please fill in this form to create an account.</p>
			<hr>

			<label for="name"><b>Name</b></label>
			<input type="text" placeholder="Enter Nickname" name="name" required>

			<label for="email"><b>Email</b></label>
			<input type="text" placeholder="E-mail must be correct." name="email" required>

			<label for="psw"><b>Password (must be at least 8 characters long)</b></label>
			<input type="password" placeholder="Enter Password" name="psw" required>

			<label for="psw-repeat"><b>Repeat Password</b></label>
			<input type="password" placeholder="Repeat Password" name="psw-repeat" required>
			<div class="clearfix">
				<button type="submit" class="signupbtn">Sign Up</button>
			</div>
		</div>
	</form>
	<?php include("footer.html") ?>
</body>

</html>
