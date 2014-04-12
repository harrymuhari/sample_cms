$(document).ready(function(){
	$('.rating span').hover(
        // Handles the mouseover
            function() {
                $(this).prevAll().andSelf().addClass('hover');
            },
         // Handles the mouseout
            function() {
                $(this).prevAll().andSelf().removeClass('hover');
		}
	);
        
	//Fetches initial rate value and displays the relevant number of shaded hearts
	var article_id = $('.comments a').attr('articleid');
	$.post('widgets/rating.php', {article_id:article_id}, function(data){
		$('.'+data+'').prevAll().andSelf().addClass('rated');
		//alert(data);
	});
		
	//Sends rate value to php script which processes and updates all necessary info
	$('.rating span').click(function(){
		var rating_submitted = $(this).attr('val');
		$.post('widgets/submit-rate.php', {rating_submitted:rating_submitted, article_id:article_id}, function(data){
			$('.'+data+'').prevAll().andSelf().addClass('rated');
			//alert(data);
		});
	});	
});