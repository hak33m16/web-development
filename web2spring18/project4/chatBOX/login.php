<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Login</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/chatbox.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <!-- All the files that are required -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    
    <!-- jQuery UI -->
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    
    <script src="js/background-changer.js"></script>
</head>
<body>

<?php

// This is where we want to begin the session
session_start();

if ( !empty($_SESSION['user']) ) {
	header("Location: groups.php");
}

////////////////////////////////////////
//
// Basic functions required for page.
//

function display_success($text) {
	echo "<div class='alert alert-success'>" . $text . "</div>";
}

function display_error($text) {
	echo "<div class='alert alert-danger'>" . $text . "</div>";
}

if ( !empty($_GET['registration']) ) {
	if ( $_GET['registration'] == "success" ) {
		display_success("Your account has been created. Please login below.");
	}
}

///////////////////////////////////////
//
// Connection to database required
// for validation of credentials.
//

include('includes/db-config.php');

$PDODBAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
$domainController = new DomainLevelController($PDODBAdapter);

if ( !empty($_POST['lg_username']) && !empty($_POST['lg_password']) ) {
	
	$user = $domainController->findUserBy("email", $_POST['lg_username']);
	//print_r($user);
	
	if ( !empty($user) && $user != null ) {
		
		if ( $user->password == md5($_POST['lg_password']) ) {
			
			//display_success("Successfully logged in.");
			
			$_SESSION['user'] = $user;
			
			header("Location: groups.php");
			
			
		} else {
			display_error("Password entry was incorrect.");
			echo $user->password . " != " . md5($_POST['lg_password']);
		}
		
	} else {
		display_error("No user with that email found.");
	}
}

?>

<!-- Where all the magic happens -->
<!-- LOGIN FORM -->
<div class="text-center">
	<!-- Main Form -->
	<div class="login-form-1">
    	<div class="logo">login</div>
		<form id="login-form" class="text-left" method="POST">
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="lg_username" class="sr-only">Username</label>
						<input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="username">
					</div>
					<div class="form-group">
						<label for="lg_password" class="sr-only">Password</label>
						<input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password">
					</div>
					<!--<div class="form-group login-group-checkbox">
						<input type="checkbox" id="lg_remember" name="lg_remember">
						<label for="lg_remember">remember</label>
					</div>-->
				</div>
				<button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
			</div>
			<div class="etc-login-form">
				<p>forgot your password? <a href="forgot_password.php">click here</a></p>
				<p>new user? <a href="registration.php">create new account</a></p>
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
</div>

</body>
</html>