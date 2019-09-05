<?php

//Generate a random string.
$token = openssl_random_pseudo_bytes(80);
echo $token;
echo "<br \>";

//Convert the binary data into hexadecimal representation.
$token = bin2hex($token);

//Print it out for example purposes.
echo $token;
