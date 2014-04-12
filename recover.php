<?php 
include 'core/init.php';
logged_in_redirect();
include 'includes/head.php';

include 'includes/header.php';
if(isset($_GET['success']) === true && empty($_GET['success']) === true){
	echo 'Thanks we\'ve emailed you';
} else {
$mode_allowed = array('username', 'password');
if(isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true){
	if(isset($_POST['email']) === true && empty($_POST['email']) === false){
			if(email_exists($_POST['email']) === true){
				recover($_GET['mode'], $_POST['email']);
				header('Location: recover.php?success');
				exit();
			} else {
				echo 'ooops'; 
			}
		}
} else {
	header('Location: index.php');
	exit();
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
			
			<h3 class="main-header">Recovery</h3>
			<div id="main-content">
			<div class="article">
				<div class="article-title"><span class="icon-torso"></span><h3>Please fill in the form below</h3></div>
					<form class="register" action="" method="POST">
					<ul>
					<li>Please enter your email:*<br />
					<input type="text" name="email" />
					<li>
					<input class="button" type="submit" value="Recover" />
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