<?php
include 'core/init.php';

$article_id = $_POST['article_id'];
$query = "SELECT * FROM `comments` WHERE `article_id` = '$article_id'";
$q = mysql_query($query) or die(mysql_error());

$row = mysql_fetch_assoc($q);

	$return['comment']	= $row['comment'];
	$return['user_id'] 	= $row['user_id'];
	$return['date']  	= $row['date'];

	echo json_encode($return);

?>