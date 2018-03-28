<?php

include 'includes/art-config.inc.php';

// separate db connection from art-config
$PDODBAdapter = DatabaseAdapterFactory::create('PDO', array(DBCONNECTION, DBUSER, DBPASS));

$genreID = 87;
if (isset($_GET['id']) && ! empty($_GET['id'])) {
    $genreID = $_GET['id'];
}
try {
    
    // make use of genre and painting gateways
    $paintingGate = new PaintingTableGateway( $PDODBAdapter );
	$genreGate = new GenreTableGateway( $PDODBAdapter );
	
}
catch (PDOException $e) {
   die( $e->getMessage() );
}



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
    
<?php include 'includes/art-header.inc.php'; ?>
    
<main >
    
	<?php
		
		$genre = $genreGate->findById( $genreID );
		
	?>
    <section class="ui segment grey100">
        <div class="ui doubling stackable grid container">
            <div class="three wide column">
                <img src="images/art/genres/square-medium/<?=$genre->GenreID?>.jpg" 
                    alt="<?=$genre->GenreName?>" class="ui big image" id="artwork">
            </div>
            <div class="thirteen wide column">
              <h1><?=$genre->GenreName?></h1>
                <p><?=$genre->Description?></p>
            </div>            
        </div>                
    </section>
    <div class="ui hidden divider"></div>
    
    <section class="ui container">
        <h3 class="ui dividing header">Paintings</h3>
        
        <div class="ui six doubling cards ">
        
        
            
            <?php // loop through paintings 
			
				$result = $paintingGate->getAllByGenre($genreID);
			
				foreach ( $result as $painting ) {
			
			?>
   
                <div class="ui fluid card">
                    <a href="single-painting.php?id=<?=$painting->PaintingID?>">
                    <div class="ui fluid image">
                        <img src="images/art/works/square-medium/<?=$painting->ImageFileName?>.jpg">
                    </div>
                    </a>
                </div>

            <?php 
			
				}
			
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