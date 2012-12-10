<?php ?>
<div id="content_right">

    <h2>Related links</h2>

    <?php if (isset($user)): ?>
        <p>Logged in as <strong><?php echo $user; ?></strong></p>
        <?php if ($this->uri->segment(1) !== 'admin'): ?>
            <p><a href="<?php echo site_url('admin'); ?>">Admin</a></p>
            <p><a href="<?php echo str_replace('database/', 'admin/', current_url()); ?>">Edit page</a></p>
        <?php else : ?>
            <p><a href="<?php echo str_replace('admin/', 'database/', current_url()); ?>">View page</a></p>
        <?php endif; ?>

    <?php endif; ?>


    <?php if (isset($artist_details)): ?>
        <h3><?php echo htmlentities($artist_details->display); ?></h3>
        <ul>
            <?php if ($artist_details->website): ?>
                <li><p><a href="<?php echo $artist_details->website; ?>"><?php echo htmlentities($artist_details->display); ?> official website</a></p></li>
            <?php endif; ?>
            <?php if ($artist_details->mbid): ?>
                <li><p><a href="http://musicbrainz.org/artist/<?php echo $artist_details->mbid; ?>"><?php echo htmlentities($artist_details->display); ?> on MusicBrainz</a></p></li>
            <?php endif; ?>
            <?php if ($artist_details->wikipedia): ?>
                <li><p><a href="<?php echo $artist_details->wikipedia; ?>"><?php echo htmlentities($artist_details->display); ?> on Wikipedia</a></p></li>
            <?php endif; ?>
            <?php if ($artist_details->myspace): ?>
                <li><p><a href="<?php echo $artist_details->myspace; ?>"><?php echo htmlentities($artist_details->display); ?> MySpace</a></p></li>
            <?php endif; ?>
            <?php if ($artist_details->slug === 'damon_and_naomi' || $artist_details->slug === 'dean_and_britta' || $artist_details->slug === 'dean_wareham'): ?>
                <li><p><a href="<?php echo site_url('database/gigography/' . $artist_details->slug . '/upcoming'); ?>">Upcoming <?php echo htmlentities($artist_details->display); ?> shows</a></p></li>

            <?php endif; ?>
        </ul>
    <?php endif; ?>



    <?php if (isset($disc)): ?>
        <h3><?php echo htmlentities($disc['details']->album); ?></h3>
        <ul>

            <?php if ($disc['details']->ASIN): ?>
                <!-- amazon stuff here -->
                <li><p><a href="https://www.amazon.com/dp/<?php echo $disc['details']->ASIN; ?>?tag=aheadfullofwi-20">Buy <?php echo $disc['details']->album; ?> from Amazon.com</a></p></li>
                <li><p><a href="https://www.amazon.co.uk/dp/<?php echo $disc['details']->ASIN; ?>?tag=aheadfullofwi-21">Buy <?php echo $disc['details']->album; ?> from Amazon.co.uk</a></p></li>

            <?php endif; ?>
            <?php if ($disc['details']->mbid): ?>
                <!-- musicbrainz stuff here -->
                <li><p><a href="http://musicbrainz.org/release/<?php echo $disc['details']->mbid; ?>">Details on MusicBrainz</a></p></li>
            <?php endif; ?>
            <?php if ($disc['details']->wikipedia): ?>
                <!-- wikipedia stuff here -->
            <?php endif; ?>
        </ul>
    <?php endif; ?>




</div>