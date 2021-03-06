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

			?>
			<h3 class="main-header">Home</h3>
			<div id="main-content">
			
			<?php include 'widgets/print-articles.php'; ?>
			
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
	include 'includes/footer.php';
?>