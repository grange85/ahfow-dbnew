<?php $this->firephp->log($disc); ?>

<div id="content_left">
    <h2><?php echo $artist_details->display . ' - ' . $disc['details']->album; ?></h2>

    <?php
    if ($disc['details']->sleeve) {
        $image_props = array(
            'src' => MEDIA_HOST . '/sleeves/' . $disc['details']->sleeve,
            'alt' => $disc['details']->album . 'sleeve',
            'width' => '200',
            'height' => '200',
            'title' => $disc['details']->album . 'sleeve'
        );
        ?>

        <div class="imagebox_right">
            <?php echo img($image_props); ?>
            <p><?php echo $disc['details']->album . ' - ' . $disc['details']->artist; ?></p>
        </div>
        <?php
    }
    ?>


    <div>
        <p><em><?php echo $disc['details']->format . ' - ' . $disc['details']->label . ' (' . $disc['details']->release_date . ')'; ?></em></p>
        <p><?php echo $this->typography->auto_typography($disc['details']->notes); ?></p>
    </div>
    <h4>Tracks</h4>
    <div>
        <ul>
            <?php foreach ($disc['tracks'] as $tracks): ?>

                <li><p><a href="<?php echo site_url('database/track/' . $tracks->track_id); ?>"><?php echo $tracks->track; ?></a>
                        <?php if ($tracks->author): ?>

                            <?php if ($tracks->notes != '') echo '<em>(' . $tracks->notes . ')</em>'; ?>
                            <?php if ($tracks->author !== 'Krukowski/Wareham/Yang') echo '<em>(' . $tracks->author . ')</em>'; ?>
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

                    <li><p><a href="<?php echo site_url('database/discography/' . $disc['details']->slug . '/' . $other->album_id); ?>"><?php echo $other->album; ?></a>
                            <em>(<?php echo $other->label; ?> - <?php echo $other->release_date; ?>)</em>
                        </p>
                    </li>
                <?php endforeach; ?>          
            </ul>
        </div>
    <?php endif; ?>

</div>