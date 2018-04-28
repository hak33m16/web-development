<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Register</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/chatbox.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <!-- All the files that are required -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
	
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
</head>
<body>

<?php

function display_error($text) {
	echo "<div class='alert alert-danger'>" . $text . "</div>";
}

// Validate registration information on server.
if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	
	$errors = false;
	
	$username = null;
	$password = null;
	$fullname = null;
	$agreebox = null;
	if (!empty($_POST['reg_username']) && !empty($_POST['reg_password']) && !empty($_POST['reg_password_confirm'])
		&& !empty($_POST['reg_fullname']) && !empty($_POST['reg_agree']) )
	{
	
		if ( $_POST['reg_password'] != $_POST['reg_password_confirm'] ) {
			display_error("Password fields do not match.");
			$errors = true;
		}
		if ( $_POST['reg_agree'] == false ) {
			display_error("Did not agree to the terms.");
			$errors = true;
		}
		if ( strlen($_POST['reg_username']) < 3 ) {
			display_error("E-mail not long enough.");
			$errors = true;
		}
		if ( strlen($_POST['reg_password']) < 8 ) {
			display_error("Password not long enough.");
			$errors = true;
		}
		if ( strlen($_POST['reg_fullname']) < 3 ) {
			display_error("Name not long enough.");
			$errors = true;
		}
		
		if ( !$errors ) {
		
			$username = $_POST['reg_username'];
			$password = $_POST['reg_password'];
			$fullname = $_POST['reg_fullname'];
			
			header('Location: login.php?registration=success');
			
		}
	
	} else {
		//echo "<div class='alert alert-danger'>Not all fields filled out.</div>";
		display_error("Not all fields filled out.");
		$errors = true;
	}
	
}


?>

<!-- Where all the magic happens -->
<!-- REGISTRATION FORM -->
<div class="text-center" style="padding:50px 0">
	<!-- Main Form -->
	<div class="login-form-1">
	
        <div class="logo">register</div>
		
		<form id="register-form" class="text-left" method="POST">
			<div class="login-form-main-message"></div>
			
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="reg_username" class="sr-only">Email address (3 - 30 char)</label>
						<input	type="text"
								class="form-control"
								id="reg_username"
								name="reg_username"
								placeholder="email address (3 - 30 char)"
								data-rule-minlength="3"
								data-rule-maxlength="30"
								required>
					</div>
					<div class="form-group">
						<label for="reg_password" class="sr-only">Password (8 - 30 char)</label>
						<input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="password (8 - 30 char)"
								data-rule-minlength="8"
								data-rule-maxlength="30"
								required>
					</div>
					<div class="form-group">
						<label for="reg_password_confirm" class="sr-only">Password Confirm</label>
						<input type="password" class="form-control" id="reg_password_confirm" name="reg_password_confirm" placeholder="confirm password"
								data-rule-minlength="8"
								data-rule-maxlength="30"
								required>
					</div>
					
					<div class="form-group">
						<label for="reg_fullname" class="sr-only">Full Name(3 - 30 char)</label>
						<input type="text" class="form-control" id="reg_fullname" name="reg_fullname" placeholder="full name (3 - 30 char)"
								data-rule-minlength="3"
								data-rule-maxlength="30"
								required>
					</div>
				
					<div class="form-group login-group-checkbox">
						<input type="checkbox" class="" id="reg_agree" name="reg_agree" required>
						<label for="reg_agree">i agree with <a href="#">terms</a></label>
					</div>
				</div>
				<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
			</div>
			
			<div class="etc-login-form">
				<p>already have an account? <a href="login.php">login here</a></p>
			</div>
		</form>
		
		<script>
		$("#register-form").validate();
		</script>
		
	</div>
	<!-- end:Main Form -->
</div>

</body>
</html>