$(document).ready(function(){
	$('#tag-selector').change(function(){
		var value = $(this, 'option:selected').val();		
		var tag = '<div class="tag">'+value+'<span class="icon-remove-circle"></span></div>';				
		$('.tag-preview').append(tag);		
		$('.tag').click(function(){
			$(this).hide();
		});
	});
	
	$('.button').click(function(){
		var tags = $('.tag').map(function(){
			return $(this).text();
		}).get();
		tags = $.unique(tags);
		var field = '<input type="text" name="tags" value="'+tags+'" />"';
		$('.tag-preview').append(field);
	});
});