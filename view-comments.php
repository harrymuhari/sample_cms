<?php
include 'core/init.php';
$comment = sanitize($_POST['comment']);
$article_id = $_GET['article_id'];
$date = date("Y-m-d H:i:s", time());

if(isset($_POST['comment']) === true && empty($_POST['comment']) === false){
	$comment_data = array(
						'comment' 		=> $comment,
						'user_id' 		=> $user_data['user_id'],
						'article_id' 	=> $article_id,
						'date' 			=> $date
						);
	add_comment($comment_data);
	header('Location: view-article.php?article_id='.$article_id);
}

if(logged_in() === false){
	echo '<span class="info icon-question"></span> You need to be logged in to post a comment';
} else { 
?>
	<!--<span class="icon-comment-alt"></span>-->

	<form action="" method="POST">
	<textarea class="comment-body" name="comment"></textarea><br>
	<input type="submit" value="Comment" class="button" />
	</form>
	
<?php
}

$query = mysql_query("SELECT * FROM `comments` WHERE `article_id` = '$article_id' ORDER BY(`date`) DESC") or die(mysql_error());

while($row = mysql_fetch_assoc($query)){
	$comment_id = $row['comment_id'];
	$user_id = $row['user_id'];
	echo '<div class="bubble-list">
			<div class="bubble">
					<img src="'.$user_data['avatar'].'" alt="User" />
					<div class="bubble-content">
						<div class="point"></div>
						<p><span class="icon-quotes-alt"></span> '.$row['comment'].'</p>
						<div class="date"><i>Posted on '.$row['date'].'</i></div>
					</div>
					<div class="moderation">';
					if(logged_in() === true && has_access($user_data['user_id'], 1)=== true){
						echo '<a class="link" href="view-article.php?article_id='.$article_id.'&user_id='.$user_id.'&comment_id='.$comment_id.'&action=delete">Delete</a><br /><a class="link" href="view-article.php?article_id='.$article_id.'&user_id='.$user_id.'&action=ban">Ban User</a>';
					} else if(logged_in() === true && $user_data['user_id'] == $row['user_id']){
						echo '<a class="link" href="view-article.php?article_id='.$article_id.'&user_id='.$user_id.'&comment_id='.$comment_id.'&action=delete">Delete</a><br />';
					} else if(logged_in() === true){
						echo '<a class="link" href="view-article.php?article_id='.$article_id.'&action=report">Report</a>';
					}
	echo 		'</div></div>
				<div class="clear"></div>
			</div>';
}

if(isset($_GET['action']) === true && empty($_GET['action']) === false){
	if($_GET['action'] == 'delete'){
		delete_comment($article_id, $_GET['comment_id'], $_GET['user_id']);
		exit();
	} else if($_GET['action'] == 'ban'){
		ban_user($_GET['user_id']);
		exit();
	} else if($_GET['action'] == 'report'){
		report_user($article_id, $_GET['comment_id'], $_GET['user_id']);
	}
}
?>