<!DOCTYPE HTML>
<html>

<head>
	<link rel="stylesheet" href="css/w3.css">
</head>

<body bgcolor="f2f1f3">
	<header>
		<div class="w3-container w3-blue">
			<div>asd</div>
			<p>The w3-container class is an important w3.CSS class.</p>
		</div>
	</header>
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
				console.log(err.name + ": " + err.message);
			});
		video.addEventListener("click", () => {
			context.drawImage(video);
		})
	</script>
</body>

</html>
