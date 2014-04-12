<?php 
require_once 'core/init.php';
logged_in_redirect(); 
?>
<div id="credentials">
<form action="widgets/login-script.php" method="POST">
	<ul>
	<li>
	<input class="login-field" type="text" name="username" placeholder="Username" />
	</li>
	<li>
	<input class="login-field" type="password" name="password" placeholder="Password" />
	</li>
	<li>
	<input class="button" type="submit" value="Login" />
	</li>
	<li>
		Don't have an account yet? <a class="link" href="register.php">Register</a>.
	</li>
	<li>
		Forgot your <a class="link" href="recover.php?mode=username">username</a> or <a class="link" href="recover.php?mode=password">password</a>?
	</li>
	</ul>
</form>
</div>