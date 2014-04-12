<?php 

include 'core/init.php';
protect_page();
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
				echo 'You have registered successfully';
			} else {

			?>
			
			<h3 class="main-header">Change Your Password</h3>
			<div id="main-content">
				<div class="article">
				<div class="article-title"><span class="icon-torso"></span><h3>Please fill in the form below</h3></div>
					<form class="register" action="changepassword-script.php" method="POST">
					<ul>
					<li>Current Password:*<br />
					<input type="password" name="c_password" />
					</li>
					<li>New Password:*<br />
					<input type="password" name="n_password" />
					</li>
					<li>Confirm New Password:*<br />
					<input type="password" name="conf_password" />
					</li>
					<li>
					<input class="button" type="submit" value="Change" />
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