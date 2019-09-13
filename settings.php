<?php
session_start();
if (!$_SESSION["user"])
	header("Location: login.php");
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8" />
	<title>Settings</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="css/w3.css" />
</head>

<body bgcolor="f2f1f3">
	<?php
	include("header.html");

	function user_email($nm) {
		require("config/database.php");
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$q = $pdo->prepare("SELECT email FROM users WHERE name = :name");
		$q->bindParam(':name', $nm);
		$q->execute();
		$email = $q->fetch()["email"];
		$pdo = null;
		return ($email);
	}
	?>
	<form action="settings_cntrllr.php" method="POST" style="border:1px solid #ccc">
		<div class="container">
			<h1>Personal Info</h1>
			<p>Please fill in this form to modify your account.</p>
			<hr>

			<label for="name"><b>Name</b></label>
			<input type="text" placeholder="Enter Nickname" name="name" value="<?php echo $_SESSION["user"] ?>" required>

			<label for="email"><b>E-mail must be correct.</b></label>
			<input type="text" placeholder="Enter Email" name="email" value="<?php echo user_email($_SESSION["user"]) ?>" required>

			<label for="psw"><b>New Password (must be at least 8 characters long)</b></label>
			<input type="password" placeholder="Enter Password" name="psw">

			<label for="psw-repeat"><b>Repeat Password</b></label>
			<input type="password" placeholder="Repeat Password" name="psw-repeat">
			<div class="clearfix">
				<button type="submit" class="signupbtn">Change</button>
			</div>
		</div>
	</form>
	<?php include("footer.html") ?>
</body>

</html>
