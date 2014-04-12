<?php
include 'core/init.php';
logged_in_redirect();
if(isset($_GET['success']) === true && empty($_GET['success']) === true){

	?>
	<h2>Thanks, we have activated your account</h2>
	<p>You're free to login</p>
	<?php

} else if(isset($_GET['email'], $_GET['email_code'])){
	$email		= trim($_GET['email']);
	$email_code	= trim($_GET['email_code']);
	
	if(email_exists($email) === false){
		$errors[] = 'Ooops! Something  went wrong, we could not find that email address';
	} else if(activate($email, $email_code) === false){
		$errors[] = 'We had a problem trying to activate your account';
	}
	
	if(empty($errors) === false){
		?>
		<h2>Ooops...</h2>
		<?php
		echo output_errors($errors);
	} else {
		header('Location:activate.php?success');
		exit;
	}
	
} else {
	header('Location:index.php');
	exit();
}

?>