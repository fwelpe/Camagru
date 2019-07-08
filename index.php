<!DOCTYPE HTML>
<html>

<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
	<header>

	</header>
	<h1>sup. H1</h1>
	<?php echo "echo from PHP" ?>
	<br />
	<br />
	<br />
	<canvas id="canvas" width="150" height="75"></canvas>
	<video id="video" autoplay width="128" height="72"></video>
	<script>
		// Prefer camera resolution nearest to 1280x720.
		var constraints = {
			video: true
		};

		navigator.mediaDevices.getUserMedia(constraints)
			.then((mediaStream) => {
				var video = document.querySelector('video');
				video.srcObject = mediaStream;
				video.onloadedmetadata = function(e) {
					video.play();
				};
			})
			.catch(function(err) {
				console.log(err.name + ": " + err.message);
			});
		const canvas = document.getElementById("canvas");
		const context = canvas.getContext("2d");
		video = document.getElementById("video");
		canvas.addEventListener("click", function() {
			context.drawImage(video, 0, 0, 128, 72);
		})
	</script>
</body>

</html>
