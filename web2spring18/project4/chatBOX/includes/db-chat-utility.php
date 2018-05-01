<?php

///////////////////////////////////////
//
// Abdel-Hakeem Badran
// 04/30/2018
//
////////////////////////
//
//

include('db-config-subdir.php');

$PDODBAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );
$domainController = new DomainLevelController($PDODBAdapter);

session_start();

////////////////////////////////
//
// sendMessage() function
//
////////////////
//
//

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['function'] === 'sendMessage' ) {
	
	if ( !empty($_SESSION['user']) && !empty($_POST['message']) && !empty($_POST['groupid']) && !empty($_POST['datetime']) ) {
			
        $date_format = 'Y-m-d H:i:s';
        
		$groupMessageArray = array(
			"groupid" => $_POST['groupid'],
			"ownerid" => $_SESSION['user']->id,
			"message" => $_POST['message'],
			"time" => date($date_format)
		);
		
		$newGroupMessage = new GroupMessage($groupMessageArray, false);
		$domainController->addMessage( $newGroupMessage );
		
	}
	
}

////////////////////////////////
//
// getChatState() function
//
////////////////
//
//

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['function'] == 'getChatState' ) {
    
    $groupid = 0;
    if ( !empty($_POST['groupid']) ) {
        $groupid = $_POST['groupid'];
    }
    
    $messages = $domainController->findAllMessagesArray($groupid);
    echo json_encode($messages);
    
}

?>