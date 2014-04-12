<?php
	include 'core\init.php';
	
	$article_id = sanitize($_POST['article_id']);
	
	if(empty($_POST) === false){
		if(empty($article_id) === true){
			$errors[] = 'Fields marked with an asterisk are required';
		}
	}


if(empty($_POST) === false && empty($errors) === true){
	delete_article($article_id);
	header('Location: admin.php?success');
	exit();
} else if(empty($errors) === false){
	echo output_errors($errors);
}
?>