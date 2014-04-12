$(document).ready(function(){
	/*
	*	REMEMBER TO RESEARCH ON THE TOGGLE EVENTS SO WHEN A USER
	*	IS TYPING NO ERRORS ARE DISPLAYED
	*	AND WHEN HE TYPES AN INVALID VALUE 
	*	AN ERROR MESSAGE APPEARS
	*/
	
	$('.reg-firstname').blur(function(){
			var firstname = $(this).val();
			if(firstname == ''){
			var status = '<span class="icon-info-sign"></span> Remember to fill this in';
				$('.firstname-status').show().html(status);
			}
			
			$(this).focus(function(){
				$('.firstname-status').hide();
				$('#reg-button').show();
			});
			
		});
	
	$('.reg-username').keyup(function(){
		var username = $(this).val();
		$.post('username-val.php', {username:username}, function(data){
			if(data){
				var status = '<span class="icon-info-sign"></span> Sorry, that username is taken';
				$('.username-status').show().html(status);
			} else {
				$('.username-status').hide();
			}
		});
	});
	
	$('.reg-username').blur(function(){
		var username = $(this).val();
		// also check for null, spaces and number in username
			if(username == ''){
				var status = '<span class="icon-info-sign"></span> Remember to fill this in';
				$('.username-status').show().html(status);
			}
			
			var regex = new RegExp("^[a-zA-Z0-9]+$");
			if(regex.test(username) == false){
				var status = '<span class="icon-info-sign"></span> Sorry, that username is invalid';
				$('.username-status').show().html(status);
			}
			
		$(this).focus(function(){
			$('.username-status').hide();
		});
	});
		
		
	$('.reg-password').blur(function(){
			var password = $(this).val();
			// check for null, length and password strength
			if(password == ''){
				var status = '<span class="icon-info-sign"></span> Remember to fill this in';
				$('.password-status').show().html(status);
			}
			
			if(password.length < 6){
				var status = '<span class="icon-info-sign"></span> At least 6 characters';
				$('.password-status').show().html(status);
			}
			
			$(this).focus(function(){
				$('.password-status').hide();
			});
		});
		
	$('.reg-conf-password').blur(function(){
			var password = $('.reg-password').val();
			var conf_password = $(this).val();
			// check for null and password mismatch
			if(password != conf_password){
				var status = '<span class="icon-info-sign"></span> Your passswords do not match';
				$('.conf-password-status').show().html(status);
			} else if (conf_password ==''){
				var status = '<span class="icon-info-sign"></span> Remember to fill this in';
				$('.conf-password-status').show().html(status);
			} else {
				$('.conf-password-status').hide();
			}
			
			$('.reg-conf-password').focus(function(){
				$('.conf-password-status').hide();
			});
		});
		
	$('.reg-email').keyup(function(){
		var email = $(this).val();
		$.post('email-val.php', {email:email}, function(data){
			if(data){
			var status = '<span class="icon-info-sign"></span> Sorry, that email is already in use';
				$('.email-status').show().html(status);
			} else {
				$('.email-status').hide();
			}
		});
	});
	
	
	$('.reg-email').blur(function(){
		var email = $(this).val();
		
		if(email == ''){
				var status = '<span class="icon-info-sign"></span> Remember to fill this in';
				$('.email-status').show().html(status);
			}
		
		var validEmail = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if(validEmail.test(email) == false){
			var status = '<span class="icon-info-sign"></span> Please re-check your email';
			$('.email-status').show().html(status);
		}
		
		if(data){
			var status = '<span class="icon-info-sign"></span> Sorry, that email is already in use';
			$('.email-status').show().html(status);
		}
		// also check whether email is valid	
		$(this).focus(function(){
			$('.email-status').hide();
		});
	});
	
	// find any child divs of form's uls, if present disable submit button
					
});