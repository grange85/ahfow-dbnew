<?php ?>
<div id="content_right">
    <h2>Related links</h2>

    <?php if (isset($artist_details)): ?>
        <ul>
            <?php if ($artist_details->website): ?>
                <li><p><a href="<?php echo $artist_details->website; ?>"><?php echo $artist_details->display; ?> official website</a></p></li>
            <?php endif; ?>
            <?php if ($artist_details->mbid): ?>
                <li><p><a href="http://musicbrainz.org/artist/<?php echo $artist_details->mbid; ?>"><?php echo $artist_details->display; ?> on MusicBrainz</a></p></li>
            <?php endif; ?>
            <?php if ($artist_details->wikipedia): ?>
                <li><p><a href="<?php echo $artist_details->wikipedia; ?>"><?php echo $artist_details->display; ?> on Wikipedia</a></p></li>
            <?php endif; ?>
            <?php if ($artist_details->myspace): ?>
                <li><p><a href="<?php echo $artist_details->myspace; ?>"><?php echo $artist_details->display; ?> MySpace</a></p></li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>

    
    
    <?php if (isset($disc)): ?>
        <?php if ($disc['details']->ASIN): ?>
            <!-- amazon stuff here -->
            <ul>
                <li><p><a href="https://www.amazon.com/dp/<?php echo $disc['details']->ASIN; ?>?tag=aheadfullofwi-20">Buy <?php echo $disc['details']->album;?> from Amazon.com</a></p></li>
                <li><p><a href="https://www.amazon.co.uk/dp/<?php echo $disc['details']->ASIN; ?>?tag=aheadfullofwi-21">Buy <?php echo $disc['details']->album;?> from Amazon.co.uk</a></p></li>
            </ul>

        <?php endif; ?>
        <?php if ($disc['details']->mbid): ?>
            <!-- musicbrainz stuff here -->
            <ul>
                <li><p><a href="http://musicbrainz.org/release/<?php echo $disc['details']->mbid; ?>">Details on MusicBrainz</a></p></li>
            </ul>
        <?php endif; ?>
        <?php if ($disc['details']->wikipedia): ?>
            <!-- wikipedia stuff here -->
        <?php endif; ?>
    <?php endif; ?>




</div>