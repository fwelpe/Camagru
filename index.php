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
	<?php
	$dir = 'stickers/src/'; // Папка с изображениями
	$cols = 3; // Количество столбцов в будущей таблице с картинками
	$files = scandir($dir); // Берём всё содержимое директории
	echo "<table>"; // Начинаем таблицу
	$k = 0; // Вспомогательный счётчик для перехода на новые строки
	for ($i = 0; $i < count($files); $i++) { // Перебираем все файлы
		if (($files[$i] != ".") && ($files[$i] != "..")) { // Текущий каталог и родительский пропускаем
			if ($k % $cols == 0) echo "<tr>"; // Добавляем новую строку
			echo "<td>"; // Начинаем столбец
			$path = $dir . $files[$i]; // Получаем путь к картинке
			echo "<a href='$path'>"; // Делаем ссылку на картинку
			echo "<img src='$path' alt='' width='100' />"; // Вывод превью картинки
			echo "</a>"; // Закрываем ссылку
			echo "</td>"; // Закрываем столбец
			/* Закрываем строку, если необходимое количество было выведено, либо данная итерация последняя */
			if ((($k + 1) % $cols == 0) || (($i + 1) == count($files))) echo "</tr>";
			$k++; // Увеличиваем вспомогательный счётчик
		}
	}
	echo "</table>"; // Закрываем таблицу
	?>
	<script>

	</script>
</body>

</html>
