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

$db_engine = new ArtStore();

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
                        <option value="<?=$artist->get_id()?>"><?=utf8_encode($artist->get_first_name())?> <?=utf8_encode($artist->get_last_name())?></option>
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
        <?php
            $NO_QUERY_PARAMS = true;
            $filtered_list = array();
            
            if ( !empty($_GET['artist']) ) {
                // Ensure it is not the default selection
                if ( $_GET['artist'] != "Select Artist" ) {
                    
                    $NO_QUERY_PARAMS = false;
                    
                    $db_engine->painting_collection->append_query( "ArtistID=" . (string)$_GET['artist'] );
                    $db_engine->painting_collection->rerun_query();
                    
                    $filtered_list = $db_engine->painting_collection->get_paintings();
                    
                    ?>
                        <h4 class="ui header" style="display: inline; padding-right: 25px;">Artist ▼ <?=utf8_encode($db_engine->artist_collection->get_artist_by_id( $_GET['artist'] )->get_first_name())?> <?=utf8_encode($db_engine->artist_collection->get_artist_by_id( $_GET['artist'] )->get_last_name())?></h1>
                    <?php
                    
                }
            }
            
            if ( !empty($_GET['museum']) ) {
                // Ensure it is not the default selection
                if ( $_GET['museum'] != "Select Museum" ) {
                    
                    $NO_QUERY_PARAMS = false;
                    
                    $db_engine->painting_collection->append_query( "GalleryID=" . (string)$_GET['museum'] );
                    $db_engine->painting_collection->rerun_query();
                    
                    $filtered_list = $db_engine->painting_collection->get_paintings();
                    
                    ?>
                        <h4 class="ui header" style="display: inline; padding-right: 25px;">Museum ▼ <?=$db_engine->galleries_collection->get_gallery_by_id( $_GET['museum'] )->get_name()?></h1>
                    <?php
                    
                }
            }
            
            if ( !empty($_GET['shape']) ) {
                // Ensure it is not the default selection
                if ( $_GET['shape'] != "Select Shape" ) {
                    
                    $NO_QUERY_PARAMS = false;
                    
                    $db_engine->painting_collection->append_query( "ShapeID=" . (string)$_GET['shape'] );
                    $db_engine->painting_collection->rerun_query();
                    
                    $filtered_list = $db_engine->painting_collection->get_paintings();
                    
                    ?>
                        <h4 class="ui header" style="display: inline;">Shape ▼ <?=$db_engine->shapes_collection->get_shapes_by_id( $_GET['shape'] )->get_shape()?></h4>
                    <?php
                    
                }
            }
            
            if ( $NO_QUERY_PARAMS ) $filtered_list = $PAINTINGS_COLLECTION; // Default, no params
        ?>

        <ul class="ui divided items" id="paintingsList">


            
            <?php
            foreach( $filtered_list as $painting ) {
                ?>
                <li class="item">
                    <a class="ui small image" href="single-painting.php?id=<?=$painting->get_id()?>">
                        <img src="images/art/works/square-medium/<?=$painting->get_image_file_name()?>.jpg">
                    </a>
                    <div class="content">
                        <a class="header" href="single-painting.php?id=<?=$painting->get_id()?>"><?=utf8_encode($painting->get_title())?></a>
                        <div class="meta">
                            <span class="cinema">
                                <?=utf8_encode($db_engine->artist_collection->get_artist_by_id( $painting->get_artist_id() )->get_first_name())?>
                                <?=" " . utf8_encode($db_engine->artist_collection->get_artist_by_id( $painting->get_artist_id() )->get_last_name())?>
                            </span>
                        </div>
                        
                        <div class="description">
                            <p><?=utf8_encode($painting->get_description())?></p>
                        </div>
                        
                        <div class="meta">     
                            <strong>$<?=(float)$painting->get_cost()?></strong>        
                        </div>
                        
                        <div class="extra">
                            <a class="ui icon orange button" href="#"<!--cart.php?id=565-->><i class="add to cart icon"></i></a>
                            <a class="ui icon button" href="#"<!--favorites.php?id=565-->><i class="heart icon"></i></a>          
                        </div>        
                    </div>      
                </li>
                <?php
            }
        ?>
          
        </ul>        
    </section>  
    
</main>    
    
  <footer class="ui black inverted segment">
      <div class="ui container">footer for later</div>
  </footer>
</body>
</html>