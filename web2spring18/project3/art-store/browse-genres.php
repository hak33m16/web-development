<?php

include 'includes/art-config.inc.php';

// separate db connection from art-config
$PDODBAdapter = DatabaseAdapterFactory::getInstance( 'PDO', array(DBCONNECTION, DBUSER, DBPASS) );

//DatabaseAdapterFactory::create('PDO', array(DBCONNECTION, DBUSER, DBPASS));

// use genre gateway
$gateway = new GenreTableGateway( $PDODBAdapter );

?>

<!DOCTYPE html>
<html lang=en>
<head>
<meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
  
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
    
    
</head>
<body >
    
<?php 

	include 'includes/art-header.inc.php';	
	
?>
    
<main >
    <section class="ui" style="background: url(images/banner1.jpg); height: 100px; padding: 20px">
        <div class="ui container">
            <h1 class="ui header">Genres</h1>
        </div>        
    </section>
    
    <section class="ui basic segment container">
       <div class="ui six stackable cards">

      <?php // loop thru genres 
		$result = $gateway->findAllSorted(true);
		foreach( $result as $genre ) {
	  ?>

            <div class="centered card">
                <div class="ui fluid image">
					<a href="single-genre.php?id=<?=$genre->GenreID?>">
						<img src="images/art/genres/square-medium/<?=$genre->GenreID?>.jpg">
					</a>
                </div>
                <div class="content">
                    <h5 class="header">
						<a href="single-genre.php?id=<?=$genre->GenreID?>"><?=$genre->GenreName?></a>
					</h5>
                </div>          
            </div>

      <?php } 
	  
	  // Ensure that connection is closed
	  $PDODBAdapter->closeConnection();
	  
	  ?>            
        
        </div>
    </section>    
</main>    
    
  <footer class="ui black inverted segment">
      <div class="ui container">footer</div>
  </footer>
</body>
</html>    