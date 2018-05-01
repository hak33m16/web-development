<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Forgot Password</title>
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
    
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
    
    <script src="js/background-changer.js"></script>
</head>
<body>

<div class="text-center">
<?php

function display_error($text) {
	echo "<div class='alert alert-danger'>" . $text . "</div>";
}

function display_success($text) {
	echo "<div class='alert alert-success'>" . $text . "</div>";
}

include('includes/db-config.php');

$PDODBAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
$domainController = new DomainLevelController($PDODBAdapter);

session_start();

if ( !empty($_POST['fp_email']) && !empty($_POST['new_password']) ) {
    
    $errors = true;
    
    $users = $domainController->findAllUsers();
    foreach ( $users as $user ) {
        if ( $user->email == $_POST['fp_email'] && strlen($_POST['new_password']) >= 8 && strlen($_POST['new_password']) <= 30 ) {
            $errors = false;
            $domainController->updateUser( $_POST['fp_email'], $_POST['new_password'] );
        }
    }
    
    if ( $errors ) {
        header("Location: forgot_password.php?error=true");
    } else {
        header("Location: forgot_password.php?success=true");
    }
    
}
    
if ( !empty($_GET['success']) ) {
    display_success("Password successfully reset, please navigate back to login.");
}
    
if ( !empty($_GET['error']) ) {
    display_error("Looks like you input something incorrectly. Please try again.");
}    
    
?>
<!-- Where all the magic happens -->
<!-- FORGOT PASSWORD FORM -->

    <div class="login-form-1">
        <div class="logo">forgot password</div>
        <!-- Main Form -->
        <form id="forgot-password-form" class="text-left" method="POST">
            <div class="etc-login-form">
                <p>When you fill in your registered email address, and new password, your password will be reset.</p>
            </div>
            <div class="login-form-main-message"></div>
            <div class="main-login-form">
                <div class="login-group">
                    <div class="form-group">
                        <label for="fp_email" class="sr-only">Email address</label>
                        <input type="text" class="form-control" id="fp_email" name="fp_email" placeholder="email address" required>
                    </div>
                    <div class="form-group">
						<label for="reg_password" class="sr-only">Password (8 - 30 char)</label>
						<input type="password" class="form-control" id="new_password" name="new_password" placeholder="new password (8 - 30 char)"
								data-rule-minlength="8"
								data-rule-maxlength="30"
								required>
					</div>
                </div>
                <button type="submit" class="login-button"><i class="fa fa-chevron-right"></i></button>
            </div>
            <div class="etc-login-form">
                <p>already have an account? <a href="login.php">login here</a></p>
                <p>new user? <a href="registration.php">create new account</a></p>
            </div>
        </form>
    </div>
	<!-- end:Main Form -->

</div>

</body>
</html>