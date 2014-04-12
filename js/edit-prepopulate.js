$(document).ready(function(){
	$('.article_id').keyup(function(){
		var search_term = $(this).val();
		
		$.post('autofill.php', {search_term:search_term}, function(data){
			$('#article_title').val(data.title);
			$('#article_text').val(data.text);
		}, 'json');

	});
});
