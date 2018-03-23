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
        <td><?php // output artist name ?></td>                       
      </tr>
      <tr>                       
        <td>Year</td>
        <td><?php // output year of work ?></td>
      </tr>       
      <tr>
        <td>Medium</td>
        <td><?php // output medium ?></td>
      </tr>  
      <tr>
        <td>Dimensions</td>
        <td><?php // output painting width and height ?>cm</td>
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

<div class="ui bottom attached tab segment" data-tab="genres">
    <ul class="ui list">
      <?php // loop thru genres ?>
        <li class="item">
          <?php // output genre as link ?>
        </li>
      <?php } ?>
    </ul>
</div>  

<div class="ui bottom attached tab segment" data-tab="subjects">
    <ul class="ui list">
          <?php // loop thru subjects ?>
            <li class="item">
              <?php // output subject as link ?>
            </li>
          <?php } ?>
    </ul>
</div>  