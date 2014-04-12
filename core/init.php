<?php
	session_start();
	error_reporting(0);
	
	require_once 'connect.php';
	require_once 'functions/general.php';
	require_once 'functions/users.php';
	require_once 'functions/articles.php';
	
	$current_file = explode('/', $_SERVER['SCRIPT_NAME']);
	$current_file = end($current_file);
	
	if(logged_in() === true){
	$session_user_id = $_SESSION['user_id'];
	$user_data = user_data($session_user_id, 'user_id', 'first_name', 'last_name', 'username', 'password', 'password_recover', 'email', 'access_level', 'allow_email', 'avatar');
	if(user_active($user_data['username']) === false){
		session_destroy();
		header('Location: index.php');
		exit();
	}
	if($current_file !== 'changepassword.php' && $current_file !== 'logout.php' && $user_data['password_recover'] == 1){
		header('Location: changepassword.php?force');
		exit();
	}
	}
	$errors = array();

?>