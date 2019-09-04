<?php
session_start();
if (!$_SESSION || !$_SESSION["user"])
	header("Location: login.php")
	?>

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
		$arr_l = count($files);
		for ($i = 0; $i < $arr_l; $i++) {
			if (($files[$i] == ".") || ($files[$i] == "..")) {
				unset($files[$i]);
			} else {
				$path = $dir . $files[$i];
				echo "<img id=" . $files[$i] .
					" class='sticker' src='$path' alt='' />";
			}
		}
		?>
	</div>
	<div id="flex">
		<video id="video" autoplay width="500" height="500"></video>
	</div>
	<img id="out" src="NoImage.png" />
	<canvas id="canvas"></canvas>
	<form enctype="multipart/form-data">
		<input type="file" id="customimg" />
		<button type="button" onclick="upload_mainpic()">Enter</button>
	</form>
	<script type='text/javascript'>
		const video = document.querySelector('video');
		const canvas = document.getElementById('canvas');
		const out = document.getElementById('out');
		canvas.width = 500;
		canvas.height = 500;
		const context = canvas.getContext('2d');
		const constraints = {
			video: {
				width: 500,
				height: 500
			}
		};
		const ids = [<?php echo '"' . implode('","', $files) . '"' ?>];
		const data = {
			width: 250,
			height: 250,
			sticker_id: null,
			capturedURI: null,
		};

		window.onload = () => {
			context.drawImage(out, 0, 0, canvas.width, canvas.height);
			data.capturedURI = canvas.toDataURL();
		};
		const upload_mainpic = () => {
			const customimg = document.getElementById('customimg');
			if (customimg.files.length) {
				const reader = new FileReader();
				reader.onload = (e) => {
					out.src = e.target.result;
					data.capturedURI = e.target.result;
					result_req(data);
				}
				reader.readAsDataURL(customimg.files[0]);
			}
		}
		const result_req = (data) => {
			fetch('pic.php', {
					headers: {
						'Accept': 'application/json',
						'Content-Type': 'application/json'
					},
					method: "POST",
					body: JSON.stringify(data)
				})
				.then((r) => {
					return r.blob()
				})
				.then((blob) => {
					out.src = URL.createObjectURL(blob)
				})
				.catch((err) => {
					// console.error(err);
				});
		}
		if (navigator.mediaDevices) {
			navigator.mediaDevices.getUserMedia(constraints)
				.then((mediaStream) => {
					video.srcObject = mediaStream;
					video.onloadedmetadata = () => {
						video.play();
					};
					video.addEventListener("click", () => {
						context.drawImage(video, 0, 0, canvas.width, canvas.height);
						data.capturedURI = canvas.toDataURL();
						result_req(data);
					})
				})
				.catch((err) => {
					// console.error(err);
				});
		};
		ids.forEach((id) => {
			const domEl = document.getElementById(id);
			if (!domEl) {
				// console.log(id);
			} else {
				domEl.addEventListener("click", () => {
					data.sticker_id = id;
					result_req(data);
				})
			}
		});
		out.addEventListener("click", (e) => {
			const rect = e.target.getBoundingClientRect();
			data.width = e.clientX - rect.left;
			data.height = e.clientY - rect.top;
			result_req(data);
		})
	</script>
</body>

</html>
