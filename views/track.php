
<div id="content_left">
    <h2><?php echo htmlentities($track_details->track); ?></h2>


    <?php if ($track_details->plays > 0): ?>
        <div>
            <p><?php echo $track_details->track; ?> was <a href="<?php echo site_url('database/track/' . $track_details->track_id . '/shows'); ?>">played live at these <?php echo $track_details->plays; ?> shows</a></p>
        </div>
    <?php endif; ?>


    <div>
        <ul>
            <?php if ($track_details->author) echo '<li><p>Written by ' . htmlentities($track_details->author) . '</p></li>'; ?>
            <?php if ($track_details->original) echo '<li><p>Originally by ' . htmlentities($track_details->original) . '</p></li>'; ?>

        </ul>
        <?php echo $this->typography->auto_typography($track_details->notes); ?>
    </div>

    <?php if ($track_details->lyrics): ?>
        <h3>Lyrics</h3>
        <div>
            <?php echo $this->typography->auto_typography($track_details->lyrics); ?>
        </div>
    <?php endif; ?>


    <?php if ($track_details->tab): ?>
        <h3>Guitar</h3>
        <div class="guitar">
            <?php echo $this->typography->auto_typography($track_details->tab); ?>

        </div>
    <?php endif; ?>


    <?php if (count($available) > 0): ?>
        <h3>Available on</h3>
        <div>
            <ul>
                <?php foreach ($available as $available): ?>

                    <li><p><a href="<?php echo site_url('database/discography/' . $available->slug . '/' . $available->album_id); ?>"><?php echo htmlentities($available->album); ?> by <?php echo htmlentities($available->display); ?></a>
                            <em>(<?php echo htmlentities($available->label); ?> - <?php echo $available->release_date; ?>)</em>
                        </p>
                    </li>
                <?php endforeach; ?>          
            </ul>

        </div>
    <?php endif; ?>


</div>