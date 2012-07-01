

<div id="content_left">
    <h2><?php echo htmlentities($artist_details->display) . ': ' . $section; ?></h2>


    <?php
    foreach (array_keys($discography) as $discography_section):
//    $this->firephp->log(key($discography));
        ?>
        <h3><a name="<?php echo urlencode($discography_section) ?>"></a><?php echo $discography_section; ?></h3>
        <ul>
            <?php foreach ($discography[$discography_section] as $item) : ?>
                <li><p><a href="<?php echo site_url('database/discography/' . $artist_details->slug . '/' . $item->album_id); ?>"><?php echo htmlentities($item->album); ?> (<?php echo $item->label . ' ' . $item->release_date; ?>)</a></p></li>
            <?php endforeach; ?>

        </ul><p class="backtotop"><a href="#top">Back to the top</a></p>

    <?php endforeach; ?>
</div>