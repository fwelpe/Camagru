<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" href="/css/bootstrap.min.css">
	</head>
	<body>
		<h1>sup H1</h1>
		<?php print "echo from PHP\n" ?>
		<br />
		<br />
		<br />
		<form action="UploadContent.php" method="POST" enctype="multipart/form-data">
			File:
    		<input type="file" name="image"> <input type="submit" value="Upload">
		</form>
	</body>
</html>
