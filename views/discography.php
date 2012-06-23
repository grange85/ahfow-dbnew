
<?php $this->firephp->log($discography); ?>

<div id="content_left">
    <h2><?php echo $artist_details->display . ': ' . $section; ?></h2>


    <?php
    foreach (array_keys($discography) as $discography_section):
//    $this->firephp->log(key($discography));
        ?>
        <h3><?php echo $discography_section; ?></h3>
        <ul>
            <?php foreach ($discography[$discography_section] as $item) : ?>
                <li><a href="<?php echo site_url('database/discography/' . $artist_details->slug . '/' . $item->album_id); ?>"><?php echo $item->album; ?> (<?php echo $item->label . ' ' . $item->release_date; ?>)</a></li>
            <?php endforeach; ?>
        </ul>

    <?php endforeach; ?>
</div>