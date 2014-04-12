<?php
include 'core/init.php';

if(count_articles() == true){

	$sql = "SELECT * FROM `articles` ORDER BY `date` DESC";

	$query = mysql_query($sql);

	while($row = mysql_fetch_array($query)){
		$article_id	= $row['article_id'];
		$title 		= $row['article_title'];
		$icon 		= $row['icon'];
		$body 		= $row['body'];
		$date 		= $row['date'];
		$comments 	= $row['comments'];
		$icon 		= $row['icon'];
		$limit = 1;
						
		if(strlen($body) > 200){
			$body = substr($body, 0, 200).'[...]<a class="toggle-view" href="view-article.php?article_id='.$article_id.'" articleid="'.$article_id.'"><span class="icon-plus-sign"></span> Read more...</a>';
		}		
		echo 	'<div class="article">
					<div class="article-title"><span class="'.$icon.'"> ';
					if(has_access($user_data['user_id'], 1) === true){echo $article_id;}
		echo		'</span><h3>'.$title.'</h3></div>
					<div class="article-info">Posted on: '.$date.' 
					<span class="comments"><a href="view-article.php?article_id='.$article_id.'" articleid="'.$article_id.'">'.count_comments($article_id).' comment'.suffix(count_comments($article_id)).'</a></span>
					<span class="rating">Liked <span class="1 icon-heart"></span><span class="2 icon-heart"></span><span class="3 icon-heart"></span><span class="4 icon-heart"></span><span class="5 icon-heart"span></span></div>
					'.$body.'
					<div class="media-holder hover" hovertext="Click to expand"><a href="view-article.php?article_id='.$article_id.'" articleid="'.$article_id.'" title="Click to Expand">';
		echo		display_images($article_id, $limit);
		echo			'</a></div>
					<div class="clear"></div>';
					
					
		echo			'<div class="article-tags icon-tags">';
						display_tags($article_id);
		echo			'</div>';
					
		
		echo	'</div>';	
	}

} else {
	echo '<div class="article">
					<div class="article-title"><span class="icon-exclamation-sign"></span><h3>No articles to display at the moment</h3></div>
				</div>';
}
?>