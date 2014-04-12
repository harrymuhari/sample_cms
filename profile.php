<?php 
include 'core/init.php';

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
			
			if(isset($_GET['username']) === true && empty($_GET['username']) === false){
				$username = $_GET['username'];
				if(user_exists($username) === true){
					$user_id = user_id_from_username($username);
					$profile_data = user_data($user_id, 'first_name', 'last_name', 'email', 'avatar');
		?>
					<h3 class="main-header"><?php echo $profile_data['first_name']?>'s Profile</h3>
					
					<div id="main-content">
						<div class="article">
							<div class="article-title"><span class="icon-user"></span><h3>Details</h3></div>
							<?php echo '<img class="profile-avatar" src="'.$profile_data['avatar'].'" alt="' . $profile_data['first_name']. '\'s avatar" />';?>
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
				} else {
					echo 'Sorry that user doesn\'t exist';
				}
				
			} else {
				header('Location: index.php');
		}
	include 'includes/footer.php';
?>