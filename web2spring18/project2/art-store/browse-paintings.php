<!DOCTYPE html>
<html lang=en>
<head>
    <meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
        <script src="js/misc.js"></script>
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
    
</head>
<body >
    
<?php include 'include/art-header.inc.php' ?>
    
<?php

include 'chapter14-project1-util.php';

$db_engine = new CRMAEngine();
$ARTISTS_COLLECTION = $db_engine->artist_collection->get_artists();
$GALLERIES_COLLECTION = $db_engine->galleries_collection->get_galleries();
$PAINTINGS_COLLECTION = $db_engine->painting_collection->get_paintings();
$SHAPES_COLLECTION = $db_engine->shapes_collection->get_shapes();

?>
    
<main class="ui segment doubling stackable grid container">

    <section class="five wide column">
        <form class="ui form">
          <h4 class="ui dividing header">Filters</h4>

          <div class="field">
            <label>Artist</label>
            <select name="artist" class="ui fluid dropdown">
                <option>Select Artist</option>
                <?php
                    foreach( $ARTISTS_COLLECTION as $artist ) {
                    ?>
                        <option value="<?=$artist->get_id()?>"><?=$artist->get_first_name()?> <?=$artist->get_last_name()?></option>
                    <?php
                    }
                ?>
            </select>
          </div>
          
          <div class="field">
            <label>Museum</label>
            <select name="museum" class="ui fluid dropdown">
                <option>Select Museum</option>  
                <?php
                    foreach( $GALLERIES_COLLECTION as $gallery ) {
                    ?>
                        <option value="<?=$gallery->get_id()?>"><?=utf8_encode($gallery->get_name())?></option>
                    <?php
                    }
                ?>
            </select>
          </div>
          
          <div class="field">
            <label>Shape</label>
            <select name="shape" class="ui fluid dropdown">
                <option>Select Shape</option>  
                <?php
                    foreach( $SHAPES_COLLECTION as $shape ) {
                    ?>
                        <option value="<?=$shape->get_id()?>"><?=$shape->get_shape()?></option>
                    <?php
                    }
                ?>
            </select>
          </div>   

            <button class="small ui orange button" type="submit">
              <i class="filter icon"></i> Filter 
            </button>    

        </form>
    </section>
    

    <section class="eleven wide column">
        <h1 class="ui header">Paintings</h1>
        <ul class="ui divided items" id="paintingsList">

        <?php
            
            $filtered_list = null;
            
            if ( !empty($_GET['artist']) ) {
                // Ensure it is not the default selection
                if ( $_GET['artist'] != "Select+Artist" ) {
                    $db_engine->painting_collection->append_query( "ArtistID=" . (string)$_GET['artist'] );
                    $db_engine->painting_collection->rerun_query();
                    
                    $filtered_list = $db_engine->painting_collection->get_paintings();
                }
            }
            
            /*$filtered_list = $PAINTINGS_COLLECTION;
            
            if ( !empty($_GET['artist']) ) {
                // Ensure it is not the default selection
                if ( $_GET['artist'] != "Select+Artist" ) {
                    foreach( $PAINTINGS_COLLECTION as $painting ) {
                        //echo $_GET['artist'];
                        //print_r($painting);
                        if ( $_GET['artist'] == $painting->get_artist_id() ) {
                            //echo "Found another painting by " . $_GET['artist'];
                            
                            array_push($filtered_list, $painting);
                        }
                        
                    }
                }
            }
            
            if ( !empty($_GET['museum']) ) {
                
            }
            if ( !empty($_GET['shape']) ) {
                
            }*/
            
            //print_r($db_engine->artist_collection->get_artist_by_id(13));
            //$artists = $db_engine->artist_collection->get_artists();
            
            foreach( $filtered_list as $painting ) {
                //echo $artist->get_id() . "\n";
                ?>
                <li class="item">
                    <a class="ui small image" href="single-painting.php?id=<?=$painting->get_id()?>">
                        <img src="images/art/works/square-medium/131040.jpg">
                    </a>
                    <div class="content">
                        <a class="header" href="single-painting.php?id=<?=$painting->get_id()?>">View of St. Markís from the Punta della Dogana</a>
                        <div class="meta"><span class="cinema">Canaleto</span></div>        
                        <div class="description">
                            <p>The View of St. Markís Basin came to Brera in 1828 with the View of the Grand Canal Looking toward the Punta della Dogana from Campo SantíIvo.</p>
                        </div>
                        <div class="meta">     
                            <strong>$900</strong>        
                        </div>        
                        <div class="extra">
                            <a class="ui icon orange button" href="cart.php?id=565"><i class="add to cart icon"></i></a>
                            <a class="ui icon button" href="favorites.php?id=565"><i class="heart icon"></i></a>          
                        </div>        
                    </div>      
                </li>
                <?php
            }
            
            //for( $count = 0; $count < $db_engine->artist_collection->get_limit(); ++ $count ) {
            //    print_r($artists[$count]->get_id());
            //}
            
        ?>
        <!--
          <li class="item">
            <a class="ui small image" href="detail.php?id=565"><img src="images/art/works/square-medium/131040.jpg"></a>
            <div class="content">
              <a class="header" href="detail.php?id=565">View of St. Markís from the Punta della Dogana</a>
              <div class="meta"><span class="cinema">Canaleto</span></div>        
              <div class="description">
                <p>The View of St. Markís Basin came to Brera in 1828 with the View of the Grand Canal Looking toward the Punta della Dogana from Campo SantíIvo.</p>
              </div>
              <div class="meta">     
                  <strong>$900</strong>        
              </div>        
              <div class="extra">
                <a class="ui icon orange button" href="cart.php?id=565"><i class="add to cart icon"></i></a>
                <a class="ui icon button" href="favorites.php?id=565"><i class="heart icon"></i></a>          
              </div>        
            </div>      
          </li>

          <li class="item">
            <a class="ui small image" href="detail.php?id=568"><img src="images/art/works/square-medium/137010.jpg"></a>
            <div class="content">
              <a class="header" href="detail.php?id=568">Abbey among Oak Trees</a>
              <div class="meta"><span class="cinema">Casper David Friedrich</span></div>        
              <div class="description">
                <p>Abbey among Oak Trees is the companion piece to Monk by the Sea. Friedrich showed both paintings in the Berlin Academy Exhibition of 1810.</p>
              </div>
              <div class="meta">     
                  <strong>$900</strong>        
              </div>        
              <div class="extra">
                <a class="ui icon orange button" href="cart.php?id=568"><i class="add to cart icon"></i></a>
                <a class="ui icon button" href="favorites.php?id=568"><i class="heart icon"></i></a>          
              </div>        
            </div>      
          </li>    
        -->
          
        </ul>        
    </section>  
    
</main>    
    
  <footer class="ui black inverted segment">
      <div class="ui container">footer for later</div>
  </footer>
</body>
</html>