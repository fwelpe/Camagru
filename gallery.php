<?php
session_start();
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8" />
	<title>Gallery</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="css/w3.css" />
</head>

<body bgcolor="f2f1f3">
	<?php
	if (!$_SESSION)
		include("header2.html");
	else if (!$_SESSION["user"])
		include("header2.html");
	else
		include("header.html");
	?>
	<div id="g2">
		<?php require("config/database.php");
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$q = $pdo->prepare("SELECT * FROM pics ORDER BY date");
		$q->execute();
		while ($result = $q->fetch()) {
			?>
			<div class='gallery'>
				<a target="_blank" href="image.php?pic=<?php echo $result["picname"] ?>">
					<img src="<?php echo $result["picname"] ?>" />
				</a>
				<div class='desc'><?php echo $result["user"] . ", at " . $result["date"] ?></div>
			</div>
		<?php
		}
		$pdo = null;
		?>
	</div>
	<?php include("footer.html") ?>
</body>

</html>
