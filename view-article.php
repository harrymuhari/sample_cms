<?php 
include 'core/init.php';

include 'includes/head.php';

include 'includes/header.php';

$article_id = $_GET['article_id'];
if(isset($_GET['article_id']) === true && empty($_GET['article_id']) === false){
	if(article_exists($article_id) === false){
		$errors[] = 'That article does not exist anymore';
	} 
} else {
	$errors[] = 'Something went wrong trying to fetch the article';
}

if(empty($errors) === false){
	echo output_errors($errors);
} else {
	
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
				<div class="main-article">
				<?php
					echo display_article($article_id);
					
					include 'view-comments.php';
					}
				?>
				
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
	include 'includes/footer.php';
?>
