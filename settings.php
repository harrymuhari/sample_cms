<?php 

include 'core/init.php';
protect_page();
include 'includes/head.php';

include 'includes/header.php';

if(empty($_POST) === false){
	$required_fields = array('first_name', '$email');
	foreach($_POST as $key=>$value){
		if(empty($value) && in_array($key, $required_fields) === true){
			$errors[] = 'Fields marked with an asterisk are required';
			break 1;
		}
	}
	if(empty($errors) === true){
		if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
			$errors[] = 'A valid email address is required';
		} else if(email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']){
			$errors[] = 'The email \'' .$_POST['email']. '\'address is already in use';
		}
	} 
}

if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	echo 'Your details have been updated';
} else {
if(empty($_POST) === false && empty($errors) === true){
	$allow_email = ($_POST['allow_email'] == 'on') ? 1 : 0;
	$update_data = array(
		'first_name' => $_POST['first_name'],
		'last_name' => $_POST['second_name'],
		'email' => $_POST['email'],
		'allow_email' => $allow_email
	);
	update_user($session_user_id, $update_data);
	header('Location: settings.php?success');
} else if(empty($errors) === false){
	echo output_errors($errors);
}
 ?>


	
	<div id="content">
			<?php 
			if(logged_in() === false){
				include 'login.php';
			} else {
				include 'widgets/loggedin.php';
			}
			
			?>
			
			<h3 class="main-header">Settings</h3>
			<div id="main-content">
				<div class="article">
				<div class="article-title"><span class="icon-torso"></span><h3>Your settings</h3></div>
				Change your avatar?
				<div class="avatar">
					<?php
						if(isset($_FILES['avatar']) === true){
							if(empty($_FILES['avatar']['name']) === true){
								echo 'Please choose a file';
							} else {
								$allowed = array('jpg', 'jpeg', 'png', 'gif');
								
								$file_name = $_FILES['avatar']['name'];
								$file_extn = strtolower(end(explode('.', $file_name)));
								$file_temp = $_FILES['avatar']['tmp_name']; 
								
								if(in_array($file_extn, $allowed) === true){
									change_profile_image($session_user_id, $file_temp, $file_extn);
									header('Location: '. $current_file);
								} else {
									echo 'Incorrect file type. Allowed: <br>';
									echo implode(', ', $allowed);
								}
							}
						}
						if(empty($user_data['avatar']) === false){
							echo '<img src="' . $user_data['avatar'] . '" alt="' . $user_data['first_name']. '\'s avatar" />';
						}
					?>
						<form method="post" action="" enctype="multipart/form-data">
							<input type="file" name="avatar"><input type="submit">
						</form>
					</div>
					<div class="clear"></div>
					<form class="register" action="" method="POST">
					<ul>
					<li>First Name:*<br />
					<input type="text" name="first_name" value="<?php echo $user_data['first_name']; ?>"/>
					</li>
					<li>Second Name:<br />
					<input type="text" name="second_name" value="<?php echo $user_data['last_name']; ?>"/>
					</li>
					<li>E-mail:*<br />
					<input type="text" name="email" value="<?php echo $user_data['email']; ?>"/>
					</li>
					<li>Would you like to receive email from us?<br />
					<input type="checkbox" name="allow_email" <?php if($user_data['allow_email'] == 1){ echo 'checked=checked';}?>>
					</li>
					<li>
					<input class="button" type="submit" value="Update" />
					</li>
					</ul>
					</form>
				</div>
			</div>
		<div id="aside">
			<?php 
			include 'widgets/feeds.php';
			include 'widgets/stats.php';
			?>	
		</div>
	</div>
	<div class="clear"></div>
<?php
}
	include 'includes/footer.php';

?>