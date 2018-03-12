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

?>
    
<?php 

    /* Query Paramater Handler */

    $current_painting = $db_engine->painting_collection->search_by_id(42); // Default painting is "Glass of Absinthe"
    if ( !empty($_GET['id']) ) {
        
        if ( ctype_digit($_GET['id']) ) {
            $current_painting = $db_engine->painting_collection->search_by_id($_GET['id']);
        }
        
    }
    
    $current_artist = $db_engine->artist_collection->get_artist_by_id( $current_painting->get_artist_id() );
    $current_gallery = $db_engine->galleries_collection->get_gallery_by_id( $current_painting->get_gallery_id() );
    $current_genres = $db_engine->genres_collection->find_genres( $current_painting->get_id() );
    $current_subjects = $db_engine->subjects_collection->find_subjects( $current_painting->get_id() );
	$current_reviews = $db_engine->reviews_collection->get_reviews_by_painting_id( $current_painting->get_id() );
	
	$frames = $db_engine->types_collection->get_frames();
	$glasses = $db_engine->types_collection->get_glasses();
	$mattes = $db_engine->types_collection->get_mattes();
    
?>
    
<main >
    <!-- Main section about painting -->
    <section class="ui segment grey100">
        <div class="ui doubling stackable grid container">
		
            <div class="nine wide column">
              <img src="images/art/works/medium/<?=$current_painting->get_image_file_name()?>.jpg" alt="..." class="ui big image" id="artwork">
                
                <div class="ui fullscreen modal">
                  <div class="image content">
                      <img src="images/art/works/large/<?=$current_painting->get_image_file_name()?>.jpg" alt="..." class="image" >
                      <div class="description">
                      <p></p>
                    </div>
                  </div>
                </div>                
                
            </div>	<!-- END LEFT Picture Column --> 
			
            <div class="seven wide column">
                
                <!-- Main Info -->
                <div class="item">
					<h2 class="header"><?=$current_painting->get_title()?></h2>
					<h3><?=$current_artist->get_first_name()?> <?=$current_artist->get_last_name()?></h3>
					<div class="meta">
						<p>
                            <i class="orange star icon"></i>
                            <i class="orange star icon"></i>
                            <i class="orange star icon"></i>
                            <i class="orange star icon"></i>
                            <i class="empty star icon"></i>
						</p>
						<!--<p><em>The Anatomy Lesson of Dr. Nicolaes Tulp</em> is a 1632 oil painting by Rembrandt housed in the Mauritshuis museum in The Hague, the Netherlands. </p>-->
                        <p><?=utf8_encode($current_painting->get_description())?></p>
					</div>  
                </div>                          
                  
                <!-- Tabs For Details, Museum, Genre, Subjects -->
                <div class="ui top attached tabular menu ">
                    <a class="active item" data-tab="details"><i class="image icon"></i>Details</a>
                    <a class="item" data-tab="museum"><i class="university icon"></i>Museum</a>
                    <a class="item" data-tab="genres"><i class="theme icon"></i>Genres</a>
                    <a class="item" data-tab="subjects"><i class="cube icon"></i>Subjects</a>    
                </div>
                
                <div class="ui bottom attached active tab segment" data-tab="details">
                    <table class="ui definition very basic collapsing celled table">
					  <tbody>
						  <tr>
						 <td>
							  Artist
						  </td>
						  <td>
							<a href="browse-paintings.php?artist=<?=$current_artist->get_id()?>"><?=$current_artist->get_first_name()?> <?=$current_artist->get_last_name()?></a>
						  </td>                       
						  </tr>
						<tr>                       
						  <td>
							  Year
						  </td>
						  <td>
							<?=$current_painting->get_year_of_work()?>
						  </td>
						</tr>       
						<tr>
						  <td>
							  Medium
						  </td>
						  <td>
							<?=$current_painting->get_medium()?>
						  </td>
						</tr>  
						<tr>
						  <td>
							  Dimensions
						  </td>
						  <td>
							<?=$current_painting->get_width()?>cm x <?=$current_painting->get_height()?>cm
						  </td>
						</tr>        
					  </tbody>
					</table>
                </div>
				
                <div class="ui bottom attached tab segment" data-tab="museum">
                    <table class="ui definition very basic collapsing celled table">
                      <tbody>
                        <tr>
                          <td>
                              Museum
                          </td>
                          <td>
                            <?=utf8_encode($current_gallery->get_name())?>
                          </td>
                        </tr>       
                        <tr>
                          <td>
                              Accession #
                          </td>
                          <td>
                            <?=$current_painting->get_accession_number()?>
                          </td>
                        </tr>  
                        <tr>
                          <td>
                              Copyright
                          </td>
                          <td>
                            <?=utf8_encode($current_painting->get_copyright_text())?>
                          </td>
                        </tr>       
                        <tr>
                          <td>
                              URL
                          </td>
                          <td>
                            <a href="<?=$current_painting->get_museum_link()?>">View painting at museum site</a>
                          </td>
                        </tr>        
                      </tbody>
                    </table>    
                </div>     
                <div class="ui bottom attached tab segment" data-tab="genres">
 
                        <ul class="ui list">
                            <?php
                                foreach( $current_genres as $genre ) {
                                    ?>
                                        <li class="item"><a href="<?=$genre->get_link()?>"><?=$genre->get_name()?></a></li>
                                    <?php
                                }
                            ?>
                        </ul>

                </div>  
                <div class="ui bottom attached tab segment" data-tab="subjects">
                    <ul class="ui list">
                        
                        <?php
                            foreach( $current_subjects as $subject ) {
                                ?>
                                    <li class="item"><a href="#"><?=$subject->get_subject_name()?></a></li>
                                <?php
                            }
                        ?>
                        
                        <!--
                          <li class="item"><a href="#">People</a></li>
                            <li class="item"><a href="#">Science</a></li>-->
                    </ul>
                </div>  
                
                <!-- Cart and Price -->
                <div class="ui segment">
                    <div class="ui form">
                        <div class="ui tiny statistic">
                          <div class="value">
                            $<?=(float)$current_painting->get_msrp()?>
                          </div>
                        </div>
                        <div class="four fields">
                            <div class="three wide field">
                                <label>Quantity</label>
                                <input placeholder=0 type="number">
                            </div>                               
                            <div class="four wide field">
                                <label>Frame</label>
                                <select id="frame" class="ui search dropdown">
                                    <option>None</option>
									<?php
										foreach( $frames as $frame ) {
											?>
												<option><?=$frame->get_title()?></option>
											<?php
										}
									?>
                                    <!--<option>Ansley</option>
                                    <option>Canyon</option>-->
                                </select>
                            </div>  
                            <div class="four wide field">
                                <label>Glass</label>
                                <select id="glass" class="ui search dropdown">
                                    <option>None</option>
									<?php
										foreach( $glasses as $glass ) {
											?>
												<option><?=$glass->get_title()?></option>
											<?php
										}
									?>
                                </select>
                            </div>  
                            <div class="four wide field">
                                <label>Matt</label>
                                <select id="matt" class="ui search dropdown">
                                    <option>None</option>
									<?php
										foreach( $mattes as $matt ) {
											?>
												<option><?=$matt->get_title()?></option>
											<?php
										}
									?>
                                </select>
                            </div>           
                        </div>                     
                    </div>

                    <div class="ui divider"></div>

                    <button class="ui labeled icon orange button">
                      <i class="add to cart icon"></i>
                      Add to Cart
                    </button>
                    <button class="ui right labeled icon button">
                      <i class="heart icon"></i>
                      Add to Favorites
                    </button>        
                </div>     <!-- END Cart -->                      
                          
            </div>	<!-- END RIGHT data Column --> 
        </div>		<!-- END Grid --> 
    </section>		<!-- END Main Section --> 
    
    <!-- Tabs for Description, On the Web, Reviews -->
    <section class="ui doubling stackable grid container">
        <div class="sixteen wide column">
        
            <div class="ui top attached tabular menu ">
              <a class="active item" data-tab="first">Description</a>
              <a class="item" data-tab="second">On the Web</a>
              <a class="item" data-tab="third">Reviews</a>
            </div>
			
            <div class="ui bottom attached active tab segment" data-tab="first">
				<?=utf8_encode($current_painting->get_description())?>
            </div>	<!-- END DescriptionTab --> 
			
            <div class="ui bottom attached tab segment" data-tab="second">
				<table class="ui definition very basic collapsing celled table">
                  <tbody>
                      <tr>
                     <td>
                          Wikipedia Link
                      </td>
                      <td>
                        <a href="<?=$current_painting->get_wiki_link()?>">View painting on Wikipedia</a>
                      </td>                       
                      </tr>                       
                      
                      <tr>
                     <td>
                          Google Link
                      </td>
                      <td>
                        <a href="<?=$current_painting->get_google_link()?>">View painting on Google Art Project</a>
                      </td>                       
                      </tr>
                      
                      <tr>
                     <td>
                          Google Text
                      </td>
                      <td>
                        <p><?=utf8_encode($current_painting->get_google_description())?></p>
                      </td>                       
                      </tr>                      
                      
   
       
                  </tbody>
                </table>
            </div>   <!-- END On the Web Tab --> 
			
            <div class="ui bottom attached tab segment" data-tab="third">                
				<div class="ui feed">
					
					<?php
						$count = 0;
						foreach ($current_reviews as $review) {
							if ( $count >= 1 ) {
								?>
									<div class="ui divider"></div>  
								<?php
							}
						?>
						  <div class="event">
							<div class="content">
								<div class="date"><?=substr($review->get_review_date(), 0, 10)?></div>
								<div class="meta">
									<a class="like">
                                        <?php
                                            $count = 0;
                                            for( $count; $count < (int)$review->get_rating(); ++ $count ) {
                                            ?>
                                                <i class="star icon"></i>
                                            <?php
                                            }
                                            
                                            for ( $count; $count < 5; ++ $count ) {
                                            ?>
                                                <i class="empty star icon"></i>
                                            <?php
                                            }
                                            
                                        ?>
                                        <!--<i class="star icon"></i><i class="star icon"></i><i class="star icon"></i><i class="star icon"></i><i class="star icon"></i>-->
									</a>
								</div>                    
								<div class="summary">
                                    <?=utf8_encode($review->get_comment())?>
                                </div>       
							</div>
						  </div>
						<?php
						}
					?>
								
				</div>                                
            </div>   <!-- END Reviews Tab -->          
        
        </div>        
    </section> <!-- END Description, On the Web, Reviews Tabs --> 
    
    <!-- Related Images ... will implement this in assignment 2 -->    
    <section class="ui container">
    <h3 class="ui dividing header">Related Works</h3>        
	</section>  
	
</main>    
    

    
  <footer class="ui black inverted segment">
      <div class="ui container">footer</div>
  </footer>
</body>
</html>