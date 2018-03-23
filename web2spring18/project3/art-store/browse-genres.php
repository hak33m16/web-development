<?php

include 'includes/art-config.inc.php';

// use genre gateway

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
    <section class="ui" style="background: url(images/banner1.jpg); height: 100px; padding: 20px">
        <div class="ui container">
            <h1 class="ui header">Genres</h1>
        </div>        
    </section>
    
    <section class="ui basic segment container">
       <div class="ui six stackable cards">

      <?php // loop thru genres ?>

            <div class="centered card">
                <div class="ui fluid image">
                    <a href="single-genre.php?id=<?php // output genre id ?>"><img src="images/art/genres/square-medium/<?php // output genre id ?>.jpg"></a>
                </div>
                <div class="content">
                    <h5 class="header"><a href="single-genre.php?id=<?php // output genre id  ?>"><?php // output genre name  ?></a></h5>
                </div>          
            </div>

      <?php } ?>            
        
        </div>
    </section>    
</main>    
    
  <footer class="ui black inverted segment">
      <div class="ui container">footer</div>
  </footer>
</body>
</html>    