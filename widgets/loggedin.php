<div id="loggedin">

<?php echo '<span>Hello there <strong>' . $user_data['first_name'] . '</strong></span> '; ?>
<a class="link" href="<?php echo $user_data['username'];?>">Profile</a> | 
<a class="link" href="changepassword.php">Change password</a> | 
<a class="link" href="settings.php">Settings</a> | 
<?php 
	if(has_access($session_user_id, 1) === true){
		echo '<a class="link" href="admin.php">Admin</a> | ';
	}
?>
<a class="link" href="widgets/logout.php">Log out</a>


</div>