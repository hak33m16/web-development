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
        <td>Artist</td>
        <td><?=$artist->FirstName // output artist name ?> <?=$artist->LastName?></td>                       
      </tr>
      <tr>                       
        <td>Year</td>
        <td><?=$painting->YearOfWork // output year of work ?></td>
      </tr>       
      <tr>
        <td>Medium</td>
        <td><?=$painting->Medium // output medium ?></td>
      </tr>  
      <tr>
        <td>Dimensions</td>
        <td><?=$painting->Width // output painting width and height ?> x <?=$painting->Height?> cm</td>
      </tr>        
    </tbody>
  </table>
</div>

<div class="ui bottom attached tab segment" data-tab="museum">
    <table class="ui definition very basic collapsing celled table">
      <tbody>
        <tr>
          <td>Museum</td>
          <td>
            <?php // output gallery name ?>
          </td>
        </tr>       
        <tr>
          <td>Accession #</td>
          <td>
            <?php // output AccessionNumber ?>
          </td>
        </tr>  
        <tr>
          <td>Copyright</td>
          <td>
            <?php // output CopyrightText ?>
          </td>
        </tr>       
        <tr>
          <td>URL</td>
          <td>
            <?php // output MuseumLink ?>
          </td>
        </tr>        
      </tbody>
    </table>    
</div>   

<?php

// pull in genres from gateway
$genres = $genreGate->findForPainting($paintingID);

?>

<div class="ui bottom attached tab segment" data-tab="genres">
    <ul class="ui list">
      <?php // loop thru genres
		foreach ( $genres as $genre ) {
	  ?>
        <li class="item">
          <a href="single-genre.php?id=<?=$genre->GenreID?>"><?=$genre->GenreName?></a>
        </li>
      <?php
		}
	  ?>
    </ul>
</div>  

<?php

// pull in subjects from gateway
$subjects = $subjectGate->findForPainting($paintingID);

?>

<div class="ui bottom attached tab segment" data-tab="subjects">
    <ul class="ui list">
          <?php // loop thru subjects
			foreach ( $subjects as $subject ) {
		  ?>
            <li class="item">
              <a href="#"><?=$subject->SubjectName?></a>
            </li>
          <?php
		    }
		  ?>
    </ul>
</div>  