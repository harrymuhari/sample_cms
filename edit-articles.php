<?php

include 'core/init.php';
	
	$article_id = (int) $_POST['article_id'];
	$category 	= sanitize($_POST['category']);
	$icon 		= sanitize($_POST['icon']);
	$title 		= sanitize($_POST['title']);
	$body 		= sanitize($_POST['body']);
	$media		= sanitize($_POST['media']);
	$link		= sanitize($_POST['link']);
	$date 		= date("Y-m-d H:i:s", time());

if(empty($_POST) === false){
	$required_fields = array('$title', '$body');
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with an asterisk are required';
			break 1;
		}
	}
	if(empty($errors) === true){
		if(empty($title) === true){
			$errors[] = 'Please enter an article title';
		}
		if(empty($body) === true){
			$errors[] = 'Please enter a valid article body';
		}
	}	
}

if(empty($_POST) === false && empty($errors) === true){
	$update_data = array(
		'category'			=> $category,
		'article_title' 	=> $title,
		'body' 				=> $body,
		'date' 				=> $date,
		'link'				=> $link,
		'icon' 				=> $icon,
	);
	
	edit_article($article_id, $update_data);
	header('Location: admin.php?success');
	exit();
} else if(empty($errors) === false){
	echo output_errors($errors);
}
?>