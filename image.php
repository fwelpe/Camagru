<?php
session_start();
if (!$_SESSION)
	header("Location: login.php");
else if (!$_SESSION["user"])
	header("Location: login.php");
else if (!$_GET["pic"])
	header("Location: index.php");
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8" />
	<title>Image</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="css/w3.css" />
	<style>
		p {
			word-wrap: break-word
		}

		textarea {
			width: 100%;
			margin-top: 30px;
		}
	</style>
</head>

<body bgcolor="f2f1f3">
	<?php include("header.html") ?>
	<center style="display: block;">
		<img src="<?php echo $_GET["pic"] ?>" id="oneimg" />
	</center>
	<div style="display: flex">
		<img src="pics/like.png" width=50px onclick="like()">
		<p id="p_like"></p>
	</div>
	<br />
	<div style="display: flex">
		<img src="pics/dislike.png" width=50px onclick="dislike()">
		<p id="p_dislike"></p>
	</div>
	<script type='text/javascript'>
		const p_like = document.getElementById("p_like");
		const p_dislike = document.getElementById("p_dislike");

		const send = (type) => {
			fetch('liked_cntrllr.php', {
				method: "POST",
				mode: "same-origin",
				credentials: "same-origin",
				headers: {
					"Content-Type": "application/json"
				},
				body: JSON.stringify({
					"type": type,
					"picname": '<?php echo $_GET["pic"] ?>'
				})
			})
		}
		const like = () => {
			send('1');
			renew_likes();
		}
		const dislike = () => {
			send('0');
			renew_likes();
		}
		const renew_likes = () => {
			fetch('like_cntrllr.php', {
				method: "POST",
				mode: "same-origin",
				credentials: "same-origin",
				headers: {
					"Content-Type": "application/json"
				},
				body: JSON.stringify({
					"picname": '<?php echo $_GET["pic"] ?>'
				})
			})
			.then((r) => r.json())
			.then((json) => {
				p_like.innerHTML = json.likes;
				p_dislike.innerHTML = json.dislikes;
			})
		}
		window.onload = () => {
			renew_likes();
		}
	</script>
	<?php
	require("config/database.php");
	$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$q = $pdo->prepare("SELECT * FROM comments WHERE picname = :p ORDER BY date ASC");
	$q->bindParam(':p', $_GET["pic"]);
	$q->execute();
	while ($result = $q->fetch()) {
		echo "<p>At " . $result["date"] . " user \"" . $result["user"] . "\" wrote:<br />" . $result["comment"] . "\r\n\r\n";
	}
	$pdo = null;
	?>
	<textarea name="comment" form="usrform" rows="6" placeholder="Type your comment..." required></textarea>
	<form action="commentadd_cntrllr.php" method="POST" id="usrform">
		<input type="hidden" name="pic" value="<?php echo $_GET["pic"] ?>">
		<input type="submit">
	</form>
	<?php include("footer.html") ?>
</body>

</html>
