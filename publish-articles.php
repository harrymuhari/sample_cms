<?php

include 'core/init.php';
	
	$icon 		= publish_sanitize($_POST['icon']);
	$title 		= publish_sanitize($_POST['title']);
	$body 		= publish_sanitize($_POST['body']);
	$media		= publish_sanitize($_FILE['media']);
	$link		= publish_sanitize($_POST['link']);
	$tags		= publish_sanitize($_POST['tags']);
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

if(empty($_POST) === false && empty($errors) === true && isset($_FILES['images']) === true && empty($_FILES['images']) === false){
	$files = $_FILES['images'];
	$article_data = array(
		'article_title' 	=> $title,
		'body' 				=> $body,
		'date' 				=> $date,
		'link'				=> $link,
		'icon' 				=> $icon,
	);
	
	publish_article($article_data);
	if($tags != ''){
		insert_tags($tags);
	}
	upload_images($files);
	header('Location: admin.php?success');
	exit();
} else if(empty($errors) === false){
	echo output_errors($errors);
}
?>