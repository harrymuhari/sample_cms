<?php
include 'core/init.php';

$search_term = $_POST['search_term'];
$query = "SELECT * FROM `articles` WHERE `article_id` = '$search_term'";
$q = mysql_query($query) or die(mysql_error());

$row = mysql_fetch_assoc($q);

$return['title'] = $row['article_title'];
$return['text'] = $row['body'];

echo json_encode($return);
?>