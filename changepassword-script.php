<?php
require_once 'core/init.php';
protect_page();

	$current_pass = md5($_POST['c_password']);
	$new_pass = $_POST['n_password'];
	$conf_pass = $_POST['conf_password'];
	
if(empty($_POST) === false){
	$required_fields = array('c_password', 'n_password', 'conf_password');
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with an asterisk are required';
			break 1;
		}
	}
	
	
	if($current_pass === $user_data['password']){
		if(trim($new_pass) != trim($conf_pass)){
			$errors[] = 'Your new passwords did not match';
		} else if(strlen($new_pass) <6){
			$errors[] = 'Your password must be at least 6 characters';
		}
	} else {
		$errors[] = 'The password you entered does not match with the password stored';
	}	
}

if(empty($_POST) === false && empty($errors) === true){
	change_password($session_user_id, $new_pass);
	header('Location: changepassword.php?success');
} else if(empty($errors) === false){
	echo output_errors($errors);
}
?>