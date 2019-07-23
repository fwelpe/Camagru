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
	<canvas id="canvas" width="500" height="500"></canvas>
	<video id="video" autoplay width="500" height="500"></video>
	<img id="one" src="stickers/expl.png" alt='' width='200' />
	<script>
		const c = 200;
		const video = document.querySelector('video');
		const canvas = document.getElementById("canvas");
		const context = canvas.getContext("2d");
		const constraints = {
			video: {
				width: 500,
				height: 500
			}
		};
		const js_array = [<?php echo '"' . implode('","', $files) . '"' ?>];
		var img = document.getElementById('one');

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
		img.addEventListener("click", () => {
			context.drawImage(img, 0, 0, img.width, img.height);
		});
		canvas.addEventListener("click", (e) => {
			var rect = e.target.getBoundingClientRect();
			var x = e.clientX - rect.left; //x position within the element.
			var y = e.clientY - rect.top; //y position within the element.
			context.drawImage(img, x - c/2, y - c/2, c, c);
		})
	</script>
</body>

</html>
