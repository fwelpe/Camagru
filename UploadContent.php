<?php

try {
	# MySQL через PDO_MYSQL
	$DBH = new PDO("mysql:host=localhost;dbname=db", "root", "ewe4");
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
echo "OK";
?>
