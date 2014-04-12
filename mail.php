<?php 

include 'core/init.php';
protect_page();
admin_protect();
include 'includes/head.php';

include 'includes/header.php';
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	echo 'Email sent!';
} else {
if(empty($_POST) === false){
	if(empty($_POST['subject']) === true){
		$errors[] = 'Subject is required';
	}
	if(empty($_POST['body']) === true){
		$errors[] = 'Body is required';
	}
	if(empty($errors) === false){
		echo output_errors($errors);
	} else {
		mail_users($_POST['subject'], $_POST['body']);
		header('Location: mail.php?success');
		exit();
	}
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
			<h3 class="main-header">Email users</h3>
			<div id="main-content">
			
			<div class="article">
				<div class="article-title"><span class="icon-file-new"></span><h3>Send users some junk</h3></div>
				<form class="admin" action="" method="POST">
				<ul>
				<li>Subject:<br />
				<input type="text" name="subject" />
				</li>
				<li>Body:<br />
				<textarea name="body" class="text"></textarea>
				</li>
				<li><p>
				<input class="button" type="submit" value="Send" />
				</li>
				</ul>
				</form>
			</div>
			
			
			
			
			</div>
		<div id="aside">
			<div id="feeds">
			Twitter feed here	
			</div>
			<div id="stats">
			Stats here			
			</div>	
		</div>
	</div>
	<div class="clear"></div>
<?php
}
	include 'includes/footer.php';
?>