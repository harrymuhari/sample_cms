<?php
function delete_comment($article_id, $comment_id, $user_id){
	$article_id = (int) $article_id;
	$comment_id = (int) $comment_id;
	$user_id = (int) $user_id;
	$query = mysql_query("DELETE FROM `comments` WHERE `article_id` = '$article_id' AND `comment_id` = '$comment_id' AND `user_id` = '$user_id'");
}

function add_comment($comment_data){
	array_walk($comment_data, 'array_sanitize');
		
	$fields = '`' .implode('`, `', array_keys($comment_data)). '`';
	$data = '\'' .implode('\', \'', $comment_data). '\'';
	
	mysql_query("INSERT INTO `comments` ($fields) VALUES ($data)");
}

function count_comments($article_id){
	return $query = mysql_result(mysql_query("SELECT COUNT(`comment_id`) FROM `comments` WHERE `article_id` = '$article_id'"), 0);
}

function display_article($article_id){
	$article_id = (int) $article_id;
	
	$query = mysql_query("SELECT * FROM `articles` WHERE `article_id` = '$article_id'");
	
	while($row = mysql_fetch_assoc($query)){
	
		$title 		= $row['article_title'];
		$icon 		= $row['icon'];
		$body 		= $row['body'];
		$date 		= $row['date'];
		$comments 	= $row['comments'];
		$icon 		= $row['icon'];
		$limit		= 100;
		
		echo $article_data = '<div class="article-title"><span class="'.$icon.'"></span><h3>'.$title.'<a class="close" href="index.php" title="Close"><span class="icon-remove-circle"></span></a></h3></div>
									<div class="article-info">Posted on: '.$date.' 
										<span class="comments"><a href="" articleid="'.$_GET['article_id'].'">'.count_comments($article_id).' comment'.suffix(count_comments($article_id)).'</a></span>
										<span class="rating">Rate:<span val="1" class="1 icon-heart"></span><span val="2" class="2 icon-heart"></span><span val="3" class="3 icon-heart"></span><span val="4" class="4 icon-heart"></span><span val="5" class="5 icon-heart"></span>
									</div>
									'.$body.'
									<div class="media-holder">
									<div class="fotorama" data-width="700" data-ratio="700/467" data-max-width="100%">';
		echo						display_images($article_id, $limit);
		echo							'</div></div>
									<div class="clear"></div>
									<a class="toggle-view" href="index.php"><span class="icon-minus-sign"></span> Read less...</a>';
									
									if(count_tags($article_id) === true){
		echo						'<div class="article-tags icon-tags">';	
		echo							display_tags($article_id);
		echo						'</div>';
									} 			
	}
}

function article_exists($article_id){
	$article_id = (int) $article_id;
	return(mysql_result(mysql_query("SELECT COUNT(`article_id`) FROM `articles` WHERE `article_id` = '$article_id'"), 0) >= 1) ? true : false;
}

function count_articles(){
	return(mysql_result(mysql_query("SELECT COUNT(`article_id`) FROM `articles`"), 0) >= 1) ? true : false;
}	

function publish_article($article_data){
	//array_walk($article_data, 'publish_sanitize');
	
	$fields = '`' .implode('`, `', array_keys($article_data)). '`';
	$data = '\'' .implode('\', \'', $article_data). '\'';
	
	mysql_query("INSERT INTO `articles` ($fields) VALUES ($data)") or die(mysql_error());
	global $article_id_fk;
	$article_id_fk = mysql_insert_id();
}

function edit_article($article_id, $update_data){
	$update = array();
	array_walk($update_data, 'array_sanitize');
	
	foreach($update_data as $field=>$data){
		$update[] = '`'.$field.'`=\''.$data.'\'';
	}
	
	mysql_query("UPDATE `articles` SET " . implode(', ', $update) . " WHERE `article_id` = $article_id") or die(mysql_error());
}

function delete_article($article_id){
	$article_id = (int) $article_id;
	
	mysql_query("DELETE FROM `articles` WHERE `article_id` = '$article_id'") or die(mysql_error());
}

function insert_tags($tags){
	global $article_id_fk; 
	$tagsArray = explode(',', $tags);
	$tagsArray = array_unique($tagsArray);
	foreach($tagsArray as $key => $values){
		$tag_query = mysql_query("INSERT INTO `tags` (`tag_name`) VALUE ('$values')");
		
		$tag_id = mysql_insert_id();
		$rel_query = mysql_query("INSERT INTO `tagtoarticle` (`tag_id`, `article_id`) VALUES ('$tag_id', '$article_id_fk')") or die(mysql_error());
	}
	
}

function count_tags($article_id){
	return(mysql_result(mysql_query("SELECT COUNT(`tag_id`) FROM `tagtoarticle` WHERE `article_id` = '$article_id'") ,0) >= 1) ? true : false;
}

function display_tags($article_id){
	$article_id = (int) $article_id;
	$query = mysql_query("SELECT * FROM tags INNER JOIN tagtoarticle USING (tag_id)	WHERE tagtoarticle.article_id = '$article_id'") or die(mysql_error());
	if(count_tags($article_id) === true){
		while($row = mysql_fetch_array($query)){
			echo $tags = '<span>'.$row['tag_name'].'</span>';
		}
	} else {
		echo '';
	}
}

function upload_images($files){
	global $article_id_fk;
	$names = $_FILES['images']['name'];
	$allowed_ext = array("jpg", "jpeg", "png", "gif");
	foreach($names as $key => $name){
		$file_extn = strtolower(end(explode('.', $_FILES['images']['name'][$key])));
		if(in_array($file_extn, $allowed_ext) === true ){
			$path = 'images/content/' . substr(md5($name), 0, 5) .'.'. $file_extn;
			$temp_names = $_FILES['images']['tmp_name'][$key];
			move_uploaded_file($temp_names, $path);
			mysql_query("INSERT INTO `images` (`image`) VALUES ('$path')") or die(mysql_error());
			
			$image_id = mysql_insert_id();
			mysql_query("INSERT INTO `imagetoarticle` (`image_id`, `article_id`) VALUES ('$image_id', '$article_id_fk')") or die(mysql_error());
		} else {
			echo 'Invalid file';
		}
	}
}

function count_images($article_id){
	return(mysql_result(mysql_query("SELECT COUNT(`image_id`) FROM `imagetoarticle` WHERE `article_id` = '$article_id'") ,0) >= 1) ? true : false;
}

function display_images($article_id, $limit){
	$article_id = (int) $article_id;
	$query = mysql_query("SELECT * FROM images INNER JOIN imagetoarticle USING (image_id) WHERE imagetoarticle.article_id = '$article_id' LIMIT $limit") or die(mysql_error());
	while($row = mysql_fetch_array($query)){
		echo $tags = '<img src="'.$row['image'].'" />';
	}
}

?>