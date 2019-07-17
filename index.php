<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="css/w3.css" />
	<link rel="stylesheet" href="css/main.css" />
</head>

<body bgcolor="f2f1f3">
	<?php include("header.html") ?>
	<canvas id="canvas"></canvas>
	<video id="video" autoplay width="500" height="500"></video>
	<script>
		const testFolder = './stickers/src/';
const fs = require('fs');

fs.readdir(testFolder, (err, files) => {
  files.forEach(file => {
    console.log(file);
  });
});

	</script>
	<script>
		const video = document.querySelector('video');
		const canvas = document.getElementById("canvas");
		const context = canvas.getContext("2d");
		const constraints = {
			video: true
		};

		navigator.mediaDevices.getUserMedia(constraints)
			.then((mediaStream) => {
				video.srcObject = mediaStream;
				video.onloadedmetadata = () => {
					video.play();
				};
			})
			.catch((err) => {
				// console.log(err.name + ": " + err.message);
			});
		video.addEventListener("click", () => {
			context.drawImage(video, 0, 0, canvas.width, canvas.height);
		});
	</script>
	<!-- <form method='post' action='up.php' enctype='multipart/form-data'>
		<input type='file' name='files[]' multiple />
		<input type='submit' value='Submit' name='submit' />
	</form> -->
	<form action="4-upload.php" method="post" enctype="multipart/form-data">
		<input type="file" name="upFile" id="upFile" accept=".png,.gif,.jpg,.webp" required>
		<input type="submit" name="submit" value="Upload Image">
	</form>
</body>

</html>
