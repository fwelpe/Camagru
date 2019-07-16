<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="css/w3.css" />
	<link rel="stylesheet" href="css/main.css" />
</head>

<body bgcolor="f2f1f3">
	<?php include("header.html") ?>
	<h1>sup. H1</h1>
	<?php echo "echo from PHP" ?>
	<br />
	<br />
	<br />
	<canvas id="canvas"></canvas>
	<video id="video" autoplay></video>
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
			context.drawImage(video, 0, 0);
		})
	</script>
</body>

</html>
