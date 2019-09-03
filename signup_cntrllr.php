<?php
function email_validate($mailstr)
{
	return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $mailstr)) ? FALSE : TRUE;
}

function form_validate()
{
	if (!$_POST)
		return "no POST";
	else if (!email_validate($_POST["email"]))
		return "wrong mail";
	else if ($_POST["psw"] !== $_POST["psw-repeat"])
		return "passwords don't match";
	else if (strlen($_POST["psw"]) < 8)
		return "password length is less than 8";
	return true;
}

$post_chk = form_validate();
if ($post_chk !== true)
	echo $post_chk;
else {

}

