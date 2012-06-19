<?php $this->firephp->log($disc); ?>

<div id="content_left">

    <div>
        <h3><?php echo $disc['details']->album; ?></h3>
        <p><?php echo $disc['details']->format . ' - ' . $disc['details']->label . ' (' . $disc['details']->release_date . ')'; ?></p>
        <p><?php echo $disc['details']->notes; ?></p>
    </div>
    <h4>Tracks</h4>
    <div>
        <ul>
            <?php foreach ($disc['tracks'] as $tracks): ?>

                <li><a href="<?php echo site_url('database/tracks/' . $tracks->track_id); ?>"><?php echo $tracks->track; ?></a>
                    <?php if ($tracks->author): ?>
                        <em>(<?php echo $tracks->author; ?>)</em>
                    <?php endif; ?>

                </li>
            <?php endforeach; ?>          
        </ul>
    </div>

    <h4>Other versions</h4>
    <div>
        <ul>
            <?php foreach ($disc['others'] as $other): ?>

                <li><a href="<?php echo site_url('database/discography/' . $disc['details']->slug . '/' . $other->album_id); ?>"><?php echo $other->album; ?></a>
                        <em>(<?php echo $other->label; ?> - <?php echo $other->release_date;?>)</em>

                </li>
            <?php endforeach; ?>          
        </ul>
    </div>

</div>