<?php $this->firephp->log($disc); ?>

<div id="content_left">
    <h2><?php echo htmlentities($artist_details->display) . ' - ' . htmlentities($disc['details']->album); ?></h2>

    <?php
    if ($disc['details']->sleeve) {
        $image_props = array(
            'src' => MEDIA_HOST . '/sleeves/' . $disc['details']->sleeve,
            'alt' => htmlentities($disc['details']->album) . 'sleeve',
            'width' => '200',
            'height' => '200',
            'title' => htmlentities($disc['details']->album) . 'sleeve'
        );
        ?>

        <div class="imagebox_right">
            <?php echo img($image_props); ?>
            <p><?php echo htmlentities($disc['details']->album) . ' - ' . htmlentities($disc['details']->artist); ?></p>
        </div>
        <?php
    }
    ?>


    <div>
        <p><em><?php echo htmlentities($disc['details']->format) . ' - ' . htmlentities($disc['details']->label) . ' (' . $disc['details']->release_date . ')'; ?></em></p>
        <p><?php echo $this->typography->auto_typography($disc['details']->notes); ?></p>
    </div>
    <h4>Tracks</h4>
    <div>
        <ul>
            <?php foreach ($disc['tracks'] as $tracks): ?>

                <li><p><a href="<?php echo site_url('database/track/' . $tracks->track_id); ?>"><?php echo htmlentities($tracks->track); ?></a>
                        <?php if ($tracks->author): ?>

                            <?php if ($tracks->notes != '') echo '<em>(' . htmlentities($tracks->notes) . ')</em>'; ?>
                            <?php if ($tracks->author !== 'Krukowski/Wareham/Yang') echo '<em>(' . htmlentities($tracks->author) . ')</em>'; ?>
                        <?php endif; ?>
                    </p>
                </li>
            <?php endforeach; ?>          
        </ul>
    </div>

    <?php if (count($disc['others']) > 0): ?>
        <h4>Other versions</h4>
        <div>
            <ul>
                <?php foreach ($disc['others'] as $other): ?>

                    <li><p><a href="<?php echo site_url('database/discography/' . $disc['details']->slug . '/' . $other->album_id); ?>"><?php echo htmlentities($other->album); ?></a>
                            <em>(<?php echo $other->label; ?> - <?php echo $other->release_date; ?>)</em>
                        </p>
                    </li>
                <?php endforeach; ?>          
            </ul>
        </div>
    <?php endif; ?>

</div>