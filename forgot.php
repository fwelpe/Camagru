<!DOCTYPE html>
<html>

<head>
	<meta charset='utf-8'>
	<title>Password recovery</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="css/w3.css" />
</head>

<body>
	<?php include("header2.html") ?>
	<form action="forgot_cntrllr.php" method="POST" style="border:1px solid #ccc">
		<div class="container">
			<h1>Password recovery</h1>
			<p>Please fill in your nickname and we will send you password reset link.</p>

			<label for="name"><b>Name</b></label>
			<input type="text" placeholder="Enter Nickname" name="name" required>

			<button type="submit">Sign Up</button>
		</div>
	</form>
</body>

</html>
