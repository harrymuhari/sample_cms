<?php
include 'core/init.php';

	$fname 		= $_POST['first_name'];
	$sname 		= $_POST['second_name'];
	$username 	= $_POST['username'];
	$password 	= $_POST['password'];
	$conf_psswd = $_POST['conf_psswd'];
	$email 		= $_POST['email'];

if(empty($_POST) === false){

	$required_fields = array('username', 'password', 'conf_password', 'first_name', 'email');
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with an asterisk are required';
			break 1;
		}
	}
	
	if(empty($errors) === true){
		if(user_exists($username) === true){
			$errors[] = 'Sorry, the username \'' .$_POST['username']. '\' is already taken.';
		}
		if(preg_match("/\\s/", $username) == true){
			$errors[] = 'Your username cannot contain spaces';
		}
		if(strlen($password) < 6){
			$errors[] = 'Your password must be at least 6 characters';
		}
		if($password !== $conf_psswd){
			$errors[] = 'Your passwords do not match';
		}
		if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
			$errors[] = 'The email you entered is not valid';		
		}
		if(email_exists($email)){
			$errors[] = 'Sorry, that email is already in use';
		}
	}
}

if(empty($_POST) === false && empty($errors) === true){
	$register_data = array(
		'first_name' 	=> $fname,
		'last_name' 	=> $sname,
		'username' 		=> $username,
		'password' 		=> $password,
		'email' 		=> $email,
		'email_code'	=> md5($username + microtime())
	);
	
	register_user($register_data);
	header('Location: register.php?success');
	exit();
} else if(empty($errors) === false){
	echo output_errors($errors);
}

?>