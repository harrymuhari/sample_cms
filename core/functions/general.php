<?php
function suffix($item){
	return $suffix = ($item != 1) ? 's' : '';
}

function admin_protect(){
	global $user_data;
	if(has_access($user_data['user_id'], 1) === false){
		header('Location: index.php');
		exit(0);
	}
}

function email($to, $subject, $body){
	mail($to, $subject, $body, 'From: harrymuhari.com');
}

function logged_in_redirect(){
	if(logged_in() === true){
		header('Location: index.php');
		exit();
	}
}

function protect_page(){
	if(logged_in() === false){
		header('Location: index.php?unauthorized');
		exit();
	}
}

function publish_sanitize($item){
	return $item = mysql_real_escape_string($item);
}

function array_sanitize($item){
	$item = htmlentities(strip_tags(mysql_real_escape_string($item)));
}

function sanitize($data){
	return htmlentities(strip_tags(mysql_real_escape_string($data)));
}

function output_errors($errors){
	$output = array();
	foreach($errors as $error){
		$output[] = '<li>'.$error.'</li>';
	}
	return '<ul>'.implode('', $output).'</ul>';
}

function print_tags($tags){
	$output = array();
	foreach($tags as $tag){
		$output[] = '<span>'.$tag.'</span>';
	}
	return implode('', $output);
}
?>