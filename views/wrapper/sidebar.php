<?php


?>
<div id="content_right">
    <h2>Related links</h2>
    &nbsp;
    <?php if ($disc['details']->ASIN):?>
        <!-- amazon stuff here -->
    <ul>
        <li><p><a href="https://www.amazon.com/dp/<?php echo $disc['details']->ASIN;?>?tag=aheadfullofwi-20">Buy from Amazon.com</a></p></li>
        <li><p><a href="https://www.amazon.co.uk/dp/<?php echo $disc['details']->ASIN;?>?tag=aheadfullofwi-21">Buy from Amazon.co.uk</a></p></li>
    </ul>
        
    <?php endif;?>
    <?php if ($disc['details']->mbid):?>
        <!-- musicbrainz stuff here -->
    <ul>
        <li><p><a href="http://musicbrainz.org/release/<?php echo $disc['details']->mbid;?>">Details on MusicBrainz</a></p></li>
    </ul>
    <?php endif;?>
    <?php if ($disc['details']->wikipedia):?>
        <!-- wikipedia stuff here -->
    <?php endif;?>
    
</div>