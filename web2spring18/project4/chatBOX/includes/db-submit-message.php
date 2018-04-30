<?php

include('includes/db-config.php');

$PDODBAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
$domainController = new DomainLevelController($PDODBAdapter);

session_start();
if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	
	if ( !empty($_SESSION['user']) && !empty($_POST['message']) && !empty($_POST['groupid']) ) {
			
		$groupArray = array(
			"groupid" => $_POST['groupid'],
			"ownerid" => $_SESSION['user']->id,
			"message" => $_POST['message'],
			"time" => null
		);
		
		$newGroupMessage = new GroupMessage($groupArray, false);
		$domainController->addMessage( $newGroupMessage );
		
	}
	
}

?>