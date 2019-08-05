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
	<div id="stickers">
		<?php
		$dir = 'stickers/src/';
		$files = scandir($dir);
		for ($i = 0; $i < count($files); $i++) {
			if (($files[$i] != ".") && ($files[$i] != "..")) {
				$path = $dir . $files[$i];
				echo "<img id=" . $files[$i] . " class='sticker' src='$path' alt='' />";
			}
		}
		?>
	</div>
	<div id="flex">
		<img id="out" />
		<video id="video" autoplay width="500" height="500"></video>
	</div>
	<canvas id="canvas"></canvas>
	<script>
		const video = document.querySelector('video');
		const canvas = document.getElementById('canvas');
		const context = canvas.getContext('2d');
		const constraints = {
			video: {
				width: 500,
				height: 500
			}
		};
		const ids = [<?php echo '"' . implode('","', $files) . '"' ?>].filter((id) => {
			return (id != '.' && id != '..')
		});
		const data = {
			width: 250;
			height: 250;
			photo_id: null,
			name: 'petr',
		}
		let captured;

		navigator.mediaDevices.getUserMedia(constraints)
			.then((mediaStream) => {
				video.srcObject = mediaStream;
				video.onloadedmetadata = () => {
					video.play();
				};
			})
			.catch((err) => {
				// console.error(err);
			});
		video.addEventListener("click", () => {
			context.drawImage(video, 0, 0, canvas.width, canvas.height);
			captured = video;
		});
		ids.forEach((id) => {
			const domEl = document.getElementById(id);

		});
		fetch('pic.php')
			.then((r) => r.blob())
			.then((blob) => out.src = URL.createObjectURL(blob));
	</script>
</body>

</html>
