<?php
$article_id = $_GET['article_id'];

$query = mysql_query("SELECT * FROM tags INNER JOIN tagtoarticle USING (tag_id)	WHERE tagtoarticle.article_id = '$article_id'") or die(mysql_error());

echo '<div class="article-tags icon-tags">';						
while($row = mysql_fetch_array($query)){
	return $tags = '<span>'.$row['tag_name'].'</span>';
}
echo '</div>';

?>