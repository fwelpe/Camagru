<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8'>
	<title>Password recovery</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel="stylesheet" href="css/w3.css" />
	<link rel="stylesheet" href="css/main.css" />
</head>

<body>
	<?php include("header2.html") ?>
	<label for="name"><b>Name</b></label>
			<input type="text" placeholder="Enter Nickname" name="name" required>

			<label for="email"><b>Email</b></label>
			<p>E-mail must be correct.</p>
			<input type="text" placeholder="Enter Email" name="email" required>

			<label for="psw"><b>Password</b></label>
			<p>Password must be at least 8 characters long.</p>
			<input type="password" placeholder="Enter Password" name="psw" required>

			<label for="psw-repeat"><b>Repeat Password</b></label>
			<input type="password" placeholder="Repeat Password" name="psw-repeat" required>
			<div class="clearfix">
				<button type="submit" class="signupbtn">Sign Up</button>
			</div>
</body>

</html>
