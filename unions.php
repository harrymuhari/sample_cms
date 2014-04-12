<?php
	include 'core/init.php';
	
	$comments_query = mysql_query("	SELECT * FROM comments
									INNER JOIN commenttoarticle 
									USING (comment_id) 
									WHERE commenttoarticle.article_id = '30' 
									ORDER BY comments.date DESC"
									) or die(mysql_error());
	
	echo '<p><ul>';
	while($cm_row = mysql_fetch_array($comments_query)){
		echo '<li>'.$cm_row['comment'].'</li>';
	}
	echo '</ul></p>';
	
	
	$tags_query = mysql_query("		SELECT * FROM tags INNER JOIN tagtoarticle
									USING (tag_id)
									WHERE tagtoarticle.article_id = '46'
									") or die(mysql_error());
	
	echo '<p><div class="tags">';
	while($tg_row = mysql_fetch_array($tags_query)){
		echo '<span>'.$tg_row['tag_name'].'</span>';
	}
	echo '</div></p>';
?>