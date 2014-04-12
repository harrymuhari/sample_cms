<?php

$connect = mysql_connect('localhost', 'root', '');

$create_db = mysql_query("CREATE DATABASE IF NOT EXISTS `harrymuhari`");

$select_db = mysql_select_db('harrymuhari');

$create_tbl_users = mysql_query("CREATE TABLE IF NOT EXISTS `users` (`user_id` INT(11) NOT NULL AUTO_INCREMENT,
																	`first_name` VARCHAR(32) NOT NULL,
																	`last_name` VARCHAR(32) NOT NULL,
																	`username` VARCHAR(32) NOT NULL,
																	`password` VARCHAR(32) NOT NULL,
																	`access_level` INT(11) NOT NULL DEFAULT 0,
																	PRIMARY KEY(user_id))");

$create_tbl_articles = mysql_query("CREATE TABLE IF NOT EXISTS `articles` (`article_id` INT NOT NULL AUTO_INCREMENT,
																			`article_title` VARCHAR(32) NOT NULL,
																			`body` TEXT NOT NULL,
																			`date` DATETIME NOT NULL,
																			`tags` TEXT NOT NULL,
																			PRIMARY KEY(article_id))");

if(!$connect || !$create_db || !$select_db || !$create_tbl_users || !$create_tbl_articles){
	echo mysql_error();
}

/*new table definitions coming up --> 

CREATE TABLE `tagtoarticle` (`article_id` INT, `tag_id` INT, 
FOREIGN KEY(`article_id`) 
REFERENCES `articles`(`article_id`),
FOREIGN KEY(`tag_id`)
REFERENCES `tags`(`tag_id`)
ON UPDATE CASCADE
ON DELETE CASCADE)

*/

?>
