$(document).ready(function(){
	$('.hover').mousemove(function(e){
		var hovertext = $(this).attr('hovertext');
		var x = e.clientX + 10;
		var y = e.clientY + 10;
		
		$('.hovertext').text(hovertext).show();
		$('.hovertext').css('top', y).css('left', x);
		
	}).mouseout(function(){
		$('.hovertext').hide();
	});	
});