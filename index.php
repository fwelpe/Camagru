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
		$dir = 'stickers/img/'; // Папка с изображениями
		$cols = 3; // Количество столбцов в будущей таблице с картинками
		$files = scandir($dir); // Берём всё содержимое директории
		echo "<table>"; // Начинаем таблицу
		echo "<tr>";
		$k = 0; // Вспомогательный счётчик для перехода на новые строки
		for ($i = 0; $i < count($files); $i++) { // Перебираем все файлы
			if (($files[$i] != ".") && ($files[$i] != "..")) { // Текущий каталог и родительский пропускаем
				// if ($k % $cols == 0) echo "<tr>"; // Добавляем новую строку
				echo "<td>"; // Начинаем столбец
				$path = $dir . $files[$i]; // Получаем путь к картинке
				echo "<a href='$path'>"; // Делаем ссылку на картинку
				echo "<img id=" . $files[$i] . " src='$path' alt='' width='100' />"; // Вывод превью картинки
				echo "</a>"; // Закрываем ссылку
				echo "</td>"; // Закрываем столбец
				/* Закрываем строку, если необходимое количество было выведено, либо данная итерация последняя */
				// if ((($k + 1) % $cols == 0) || (($i + 1) == count($files))) echo "</tr>";
				$k++; // Увеличиваем вспомогательный счётчик
			}
		}
		echo "</tr>";
		echo "</table>"; // Закрываем таблицу
		?>
	</div>
	<canvas id="canvas"></canvas>
	<canvas id="canvas-real"></canvas>
	<video id="video" autoplay width="500" height="500"></video>
	<script>
		const c = 200;
		const video = document.querySelector('video');
		const canvas = document.getElementById('canvas');
		const canvasReal = document.getElementById("canvas-real")
		const context = canvas.getContext('2d');
		const contextReal = canvasReal.getContext('2d');
		const constraints = {
			video: {
				width: 500,
				height: 500
			}
		};
		const ids = [<?php echo '"' . implode('","', $files) . '"' ?>];
		let pict;

		navigator.mediaDevices.getUserMedia(constraints)
			.then((mediaStream) => {
				video.srcObject = mediaStream;
				video.onloadedmetadata = () => {
					video.play();
				};
			});
		video.addEventListener("click", () => {
			context.drawImage(video, 0, 0, canvas.width, canvas.height);
		});
		ids.forEach((id) => {
			if (id == '.' || id == '..')
				return;
			const domEl = document.getElementById(id);

		});
		/* fetch('pic.php')
			.catch((err) =>console.log(err))
			.then((req) => {
				pict = req.blob();
			})
			.then(images => {
				outside = URL.createObjectURL(images)
				console.log(outside)
			})
		context.drawImage(pict, 0, 0); */
		const Async = async () => {
			let response = await fetch('pic.php');
			let blob = await response.blob(); // скачиваем как Blob-объект

			// создаём <img>
			let img = document.createElement('img');
			// img.style = 'position:fixed;top:10px;left:10px;width:100px';
			document.body.append(img);

			// выводим на экран
			img.src = URL.createObjectURL(blob);
		}
		Async();
	</script>
</body>

</html>
