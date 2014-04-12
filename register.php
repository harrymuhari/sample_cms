<?php 

include 'core/init.php';
logged_in_redirect();
include 'includes/head.php';

include 'includes/header.php';

 ?>


	
	<div id="content">
			<?php 
			if(logged_in() === false){
				include 'login.php';
			} else {
				include 'widgets/loggedin.php';
			}
			if(isset($_GET['success']) && empty($_GET['success'])){
				echo 'You have registered successfully. Please check your email to activate your account';
			} else {
			?>
			
			<h3 class="main-header">Register</h3>
			<div id="main-content">
				<div class="article">
				<div class="article-title"><span class="icon-torso"></span><h3>Please fill in the form below</h3></div>
					Fields marked with an asterisk are required
					<form class="register" action="register-script.php" method="POST">
					<ul>
					<li>First Name:*<br />
					<input type="text" name="first_name" class="reg-firstname" />
					<div class="firstname-status"></div>
					</li>
					<li>Second Name:<br />
					<input type="text" name="second_name" />
					</li>
					<li>Username:*<br />
					<input type="text" name="username" class="reg-username" />
					<div class="username-status"></div>
					</li>
					<li>Password:*<br />
					<input type="password" name="password" class="reg-password" />
					<div class="password-status"></div>
					</li>
					<li>Confirm password:*<br />
					<input type="password" name="conf_psswd" class="reg-conf-password" />
					<div class="conf-password-status"></div>
					</li>
					<li>E-mail:*<br />
					<input type="text" name="email" class="reg-email" />
					<div class="email-status"></div>
					</li>
					<li>
					<input class="button" id="reg-button" type="submit" value="Register" />
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