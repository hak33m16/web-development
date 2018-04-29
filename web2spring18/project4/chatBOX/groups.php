<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>Groups</title>
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
	
	<script src="js/button-utilities.js"></script>
</head>

<?php

/////////////////////////////////////
//
// Database management stuff.
//

include('includes/db-config.php');

$PDODBAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
$domainController = new DomainLevelController($PDODBAdapter);

/////////////////////////////////////
//
// Groups gateway stuff.
//

$groups = $domainController->findAllGroups();

/////////////////////////////////////

$user = null;

function display_error($text) {
	echo "<div class='alert alert-danger'>" . $text . "</div>";
}
function display_success($text) {
	echo "<div class='alert alert-success'>" . $text . "</div>";
}

// This page will handle group creation
if (!empty( $_GET['newgroup'] )) {
	
	// Check if group exists through gateway
	
	$groupExists = false;
	foreach ( $groups as $group ) {
		if ( $group->name == $_GET['newgroup'] ) {
			$groupExists = true;
		}
	}
	
	if ( $groupExists ) {
		display_error("This group already exists.");
	} else {
		
		// Create the group since it doesn't exist, and 'refresh' the group list
		$groupArray = array(
			"id" => 0,
			"name" => $_GET['newgroup']
		);

		$newGroup = new Group($groupArray, false);
		$domainController->addGroup( $newGroup );
		
		display_success("Your new group: '" . $_GET['newgroup'] . "' was created successfully.");
		unset($_GET['newgroup']);
	}
	
}

session_start();
if (!empty( $_SESSION['user'] )) {
	$user = $_SESSION['user'];
} else {
	display_error("No user logged in.");
}

?>

<body>
<div class="container">

	<div class="row text-center">
		<div class="chatbox-main-style">
			<h2>ChatBOX</h2>
			<h4>A better way to chat... with a box?</h4>
			<br>
			<h5>Logged in as: <a href="#"><?=$user->email?></a></h5>
		</div>
	</div>

	<div class="row text-center">
		<div class="dropdown btn-group">
			<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Groups <span class="caret"></span></button>
			<ul class="dropdown-menu">
				<?php
					// Pull all groups from gateway with href to index.php and their groupid
					foreach ( $groups as $group ) {
						?>
						<li><a href="index.php?groupid=<?=$group->id?>"><?=$group->name?></a></li>
						<?php
					}
				?>
				<li class="divider"></li>
				<li><a href="#" data-toggle="modal" data-target="#newGroupModal">Other</a></li>
				<!--<button id="filterButton" class="btn btn-primary navbar-btn"  >Other</button>-->
			</ul>
		</div>
	</div>
</div>
<div class="container">
	<!-- Scrolling Page Issue: https://github.com/twbs/bootstrap/issues/15229 -->
	<!-- New Group Modal -->
	<div class="row">
		<div class="modal fade" id="newGroupModal" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content -->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h2 class="modal-title"><strong>Create a Group</strong></h4>
					</div>
					<div class="modal-body">
						<div class="container">
							<div class="row">
								<div class="container">
									<h4><b>Group Name</b></h4>

									<div id="epochContainer">
										<input type="text" id="groupName" style="">
									</div>

								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" data-dismiss="modal" id="createNewGroupButton">Create</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>
</body>