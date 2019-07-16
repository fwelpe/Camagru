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
	<video id="video" autoplay width="640" height="480"></video>
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

	<img src="stickers/src/file_3567088.webp" alt="WebP rules." />

	<form method='post' action='up.php' enctype='multipart/form-data'>
  <input type='file' name='files[]' multiple />
  <input type='submit' value='Submit' name='submit' />
</form>
</body>

</html>
