<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge'>
	<title>Page Title</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel='stylesheet' type='text/css' media='screen' href='css/main.css'>
	<link rel='stylesheet' type='text/css' media='screen' href='css/w3.css'>
	<style>
		body {
			font-family: Arial, Helvetica, sans-serif;
		}

		* {
			box-sizing: border-box
		}

		/* Full-width input fields */
		input[type=text],
		input[type=password] {
			width: 100%;
			padding: 15px;
			margin: 5px 0 22px 0;
			display: inline-block;
			border: none;
			background: #f1f1f1;
		}

		input[type=text]:focus,
		input[type=password]:focus {
			background-color: #ddd;
			outline: none;
		}

		hr {
			border: 1px solid #f1f1f1;
			margin-bottom: 25px;
		}

		/* Set a style for all buttons */
		button {
			background-color: #4CAF50;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
			width: 100%;
			opacity: 0.9;
		}

		button:hover {
			opacity: 1;
		}

		/* Extra styles for the cancel button */
		.cancelbtn {
			padding: 14px 20px;
			background-color: #f44336;
		}

		/* Float cancel and signup buttons and add an equal width */
		.signupbtn {
			float: left;
			width: 100%;
		}

		/* Add padding to container elements */
		.container {
			padding: 16px;
		}

		/* Clear floats */
		.clearfix::after {
			content: "";
			clear: both;
			display: table;
		}

		/* Change styles for cancel button and signup button on extra small screens */
		@media screen and (max-width: 300px) {

			.cancelbtn,
			.signupbtn {
				width: 100%;
			}
		}

		h3 {
			font-style: italic;
		}
	</style>
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
		</div>
	</form>
</body>

</html>
