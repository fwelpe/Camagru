<?php
require_once("config/setup.php");
session_start();
if (!$_SESSION)
	header("Location: login.php");
else if (!$_SESSION["user"])
	header("Location: login.php");
?>

<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8" />
	<title>Add Post</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="css/w3.css" />
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
	<p>Choose sticker by clicking on it ↑</p>
	<div id="post">
		<video id="video" autoplay width="500" height="500"></video>
		<p>Capture camera frame by clicking on video ↑</p>
		<img id="out" src="no-picture-yet.jpg" height="500" width="500" onerror="this.src = 'x.png'" />
		<p>And set sticker center ↑</p>
		<canvas id="canvas"></canvas>
		<form enctype="multipart/form-data" id="customform">
			<input type="file" id="customimg" onchange="upload_mainpic()" />
		</form>
		<p>↑ (Optionally) upload custom image</p>
		<button id="postb" onclick="post()" disabled>Post result</button>
	</div>
	<div id="g">
		<?php
		require("config/database.php");
		$pdo = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$q = $pdo->prepare("SELECT * FROM pics WHERE user = :u ORDER BY date DESC");
		$q->bindParam(':u', $_SESSION["user"]);
		$q->execute();
		while ($result = $q->fetch()) {
			?>
			<div class='gallery'>
				<a target="_blank" href="delpic_cntrllr.php?picname=<?php echo $result["picname"] ?>">
					<img src="<?php echo $result["picname"] ?>" />
				</a>
				<div class='desc'>Click to delete</div>
			</div>
		<?php
		}
		$pdo = null;
		?>
	</div>
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
			nopic: true
		};
		const postb = document.getElementById("postb");

		const post = () => {
			context.drawImage(out, 0, 0, canvas.width, canvas.height);
			const uri = canvas.toDataURL();
			fetch('post_cntrllr.php', {
					headers: {},
					method: "POST",
					body: uri
				})
				.then((r) => {
					postb.setAttribute("disabled", "disabled");
					postb.innerHTML = "<b>UPLOADED</b>";
					postb.setAttribute("style", "opacity: 0.8");
				})
		}
		window.onload = () => { // для работы стикеров со стоковым изображением в img id="out"
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
					data.nopic = false;
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
					if (!data.nopic && data.sticker_id)
						postb.removeAttribute("disabled");
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
						data.nopic = false;
						result_req(data);
					})
				})
				.catch((err) => {
					// console.error(err);
					video.setAttribute("poster", "camera-not-available.png");
				});
		} else {
			video.setAttribute("poster", "camera-not-available.png");
		}
		ids.forEach((id) => {
			const domEl = document.getElementById(id);
			if (domEl) {
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
	<?php include("footer.html") ?>
</body>

</html>
