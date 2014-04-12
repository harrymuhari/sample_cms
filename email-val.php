<?php
include 'core/init.php';

//Check email availability ...There's an email_exists() function that returns true and false
$email = $_POST['email'];
echo email_exists($email);

?>