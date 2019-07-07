<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
	</head>
	<body>
		<h1>sup H1</h1>
		<?php print "echo from PHP\n" ?>
		<br />
		<br />
		<br />
		<form action="UploadContent.php" method="POST" enctype="multipart/form-data">
			File:
    		<input type="file" name="image"> <input type="submit" value="Upload">
		</form>
		<div id="my_camera"></div>
		<input type=button value="Take Snapshot" onClick="take_snapshot()">
		<script language="JavaScript">
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
  
    Webcam.attach( '#my_camera' );
  
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
        } );
    }
</script>
	</body>
</html>
