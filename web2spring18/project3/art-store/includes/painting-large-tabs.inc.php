<?php

/*
*
* Note that PHP variables come from parent page:
* single-painting.php
* which has children pages:
* painting-small-tabs.inc.php
* painting-large-tabs.inc.php
*
*/

?>

<section class="ui doubling stackable grid container">
    <div class="sixteen wide column">
    
        <div class="ui top attached tabular menu ">
          <a class="active item" data-tab="first">Description</a>
          <a class="item" data-tab="second">On the Web</a>
          <a class="item" data-tab="third">Reviews</a>
        </div>
        <div class="ui bottom attached active tab segment" data-tab="first">
         <?=$painting->Description?>
        </div>
        <div class="ui bottom attached tab segment" data-tab="second">

<table class="ui definition very basic collapsing celled table">
    <tbody>
      <tr>
        <td>Wikipedia Link</td>
        <td>
        <a href="<?=$painting->WikiLink?>"><?=$painting->WikiLink?></a>
        </td>                       
      </tr>                       
      
      <tr>
         <td>Google Link</td>
          <td>
            <a href="<?=$painting->GoogleLink?>"><?=$painting->GoogleLink?></a>
          </td>                       
      </tr>
     
      <tr>
        <td>Google Description</td>
        <td><?=$painting->GoogleDescription
		// output Google Description if it's not empty  ?></td>                       
      </tr>                      
    </tbody>
</table>

        </div>
        <div class="ui bottom attached tab segment" data-tab="third">

          <div class="ui feed">
              
              <!--<?php foreach ($reviews as $rev) { ?>-->
              
              <!--<div class="event">-->
              <!--  <div class="content">-->
              <!--      <div class="date"><?php echo $rev["ReviewDate"]; ?></div>-->
              <!--      <div class="meta">-->
              <!--          <a class="like">-->
              <!--            <?php echo generateReviewStars($rev["Rating"]); ?>-->
              <!--          </a>-->
              <!--      </div>                    -->
              <!--      <div class="summary">-->
              <!--          <?php echo $rev["Comment"] ?>       -->
              <!--      </div>       -->
              <!--  </div>-->
              <!--</div>-->
              <!--<div class="ui divider"></div>    -->
              
              <!--<?php } ?>-->
              
          </div>                
            
        </div>            
    
    </div>        
</section> 