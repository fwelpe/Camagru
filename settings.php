<?php
session_start();
if (!$_SESSION["user"])
	header("Location: login.php");
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8" />
	<title>Add Post</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="css/w3.css" />
</head>

<body bgcolor="f2f1f3">
	<?php include("header.html") ?>
</body>

</html>
