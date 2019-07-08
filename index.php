<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
		<h1>sup H1</h1>
		<?php print "echo from PHP\n" ?>
		<br />
		<br />
		<br />
		<form method="POST" action="storeImage.php">
			<input type="file" accept="image/*;capture=camera" name="qwe">
			<input type="submit">
		</form>

		<video autoplay></video>

<script>
  var onFailSoHard = function(e) {
    console.log('Reeeejected!', e);
  };

  // Not showing vendor prefixes.
  navigator.getUserMedia('video', function(localMediaStream) {
    var video = document.querySelector('video');
    video.src = window.URL.createObjectURL(localMediaStream);

    // Note: onloadedmetadata doesn't fire in Chrome when using it with getUserMedia.
    // See crbug.com/110938.
    video.onloadedmetadata = function(e) {
      // Ready to go. Do some stuff.
    };
  }, onFailSoHard);
  navigator.webkitGetUserMedia('audio, video', function(localMediaStream) {
  var video = document.querySelector('video');
  video.src = window.webkitURL.createObjectURL(localMediaStream);
}, onFailSoHard);
</script>
	</body>
</html>
