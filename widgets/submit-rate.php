<?php
include '../core/init.php';

$rating_submitted = $_POST['rating_submitted'];
$article_id = $_POST['article_id'];
$user_id = $user_data['user_id'];

$rate_query = mysql_query("INSERT INTO `ratings` (`rating_submitted`, `article_id`, `user_id`) VALUES ('$rating_submitted', '$article_id', '$user_id')") or die(mysql_error());

$sum_rate = mysql_result(mysql_query("SELECT SUM(`rating_submitted`) FROM `ratings` WHERE `article_id` = '$article_id'"), 0) or die(mysql_error());
// echo $sum_rate;

$total_votes = mysql_result(mysql_query("SELECT COUNT(`rating_id`) FROM `ratings` WHERE `article_id` = '$article_id'"), 0) or die(mysql_error());
// echo $total_votes;

$average_rate = $sum_rate / $total_votes;

$new_average_query = mysql_query("UPDATE `ratings` SET `average_rate` = '$average_rate' WHERE `article_id` = '$article_id'") or die(mysql_error());
?>