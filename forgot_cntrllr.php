<?php
function send_confirm($name, $email) {
	require("config/site.php");
	$conf_link = "http://" . $ADDR . "/confirm.php?uname=" . $name;
	$msg = "Please, confirm your account, using this link: " .$conf_link;
	return mail($email, "Confirmation link (Camagru)", $msg);
}

if (!$_POST)
	echo "no POST";
else if (!$_POST["name"])
	"oops you just broke my site! very well done";
else {

}
?>
