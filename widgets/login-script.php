<?php

include '../core/init.php';

if(empty($_POST) === false){
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) === true || empty($password) === true){
		$errors[] = 'You need to enter a username and password';
	} else if(user_exists($username) === false){
		$errors[] = 'We couldn\'t find that user, have you registered?';
	} else if(user_active($username) === false){
		$errors[] = 'You havent\'t activated your account';
	} else {
			if(strlen($password) > 32){
				$errors[] = 'Password is too long';
			}
	
		$login = login($username, $password);
		if($login === false){
			$errors[] = 'That username/password combination does not exist';
		} else {
			$_SESSION['user_id'] = $login;
			header('Location: ../index.php');
			exit();
		}
	}
} else {
	$errors[] = 'No data received';
}

if(empty($errors) === false){
	echo '<h3>Notice</h3>';
	echo output_errors($errors);
}
include '../includes/footer.php';
?>