<?php
session_start();
require("config/database.php");
if ($_POST["uname"]) {
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare("SELECT hash FROM users WHERE name = :name");
	$q->bindParam(':name', $_POST["uname"]);
	$q->execute();
	foreach($q as $v) {
		var_dump($v);
		echo '<br />';
	}
	/* if (hash('gost-crypto', $_POST["psw"]) === $q) {
		$_SESSION["user"] = $_POST["uname"];
		header("Location: index.php");
	} */
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
	<style>
		body {
			font-family: Arial, Helvetica, sans-serif;
		}

		form {
			border: 3px solid #f1f1f1;
		}

		input[type=text],
		input[type=password] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			box-sizing: border-box;
		}

		button {
			background-color: #4CAF50;
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
			width: 100%;
		}

		button:hover {
			opacity: 0.8;
		}

		.cancelbtn {
			width: auto;
			padding: 10px 18px;
			background-color: #f44336;
		}

		.imgcontainer {
			text-align: center;
			margin: 24px 0 12px 0;
		}

		img.avatar {
			width: 40%;
			border-radius: 50%;
		}

		.container {
			padding: 16px;
		}

		span.psw {
			float: right;
			padding-top: 16px;
		}

		/* Change styles for span and cancel button on extra small screens */
		@media screen and (max-width: 300px) {
			span.psw {
				display: block;
				float: none;
			}

			.cancelbtn {
				width: 100%;
			}
		}
	</style>
</head>

<body>
	<?php include("header.html") ?>
	<form action="#" method="POST">


		<div class="container">
			<label for="uname"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="uname" required>

			<label for="psw"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="psw" required>

			<button type="submit">Login</button>

		</div>

		<div class="container" style="background-color:#f1f1f1">
			<button type="button" class="cancelbtn">Cancel</button>
			<span class="psw">Forgot <a href="#">password?</a></span>
		</div>
	</form>

</body>

</html>
