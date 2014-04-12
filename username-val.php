<?php
include 'core/init.php';

//Check username availability ....There's a user_exists() function that returns true or false
$username = $_POST['username'];
echo user_exists($username);

?>