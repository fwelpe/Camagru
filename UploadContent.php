<?php

try {
	# MySQL через PDO_MYSQL
	$DBH = new PDO("mysql:host=localhost;dbname=db", "root", "Rerfderf5");
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
echo "OK";
?>
