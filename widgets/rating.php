<?php
include '../core/init.php';

$article_id = $_POST['article_id'];
$rate_submitted = $_POST['rate_submitted'];
$user_id = $user_data['user_id'];

$query = mysql_query("SELECT * FROM `ratings` WHERE `article_id` = '$article_id' LIMIT 1") or die(mysql_error());
while($row = mysql_fetch_array($query)){
	echo $row['average_rate'];
}

?>