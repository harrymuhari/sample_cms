$(document).ready(function(){
	$('.select-icon').change(function(){
		var value = $(this, 'option:selected').val();
		var span = '<span class="'+ value +'"></span>';
		$('#icon-preview').html(span);
	});
});