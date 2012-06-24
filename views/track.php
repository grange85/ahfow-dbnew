
<div id="content_left">
    <h2><?php echo $track_list['track_details']->track; ?></h2>

    <div>
        <ul>
            <?php if ($track_list['track_details']->author) echo '<li><p>Written by ' . $track_list['track_details']->author . '</p></li>'; ?>
            <?php if ($track_list['track_details']->original) echo '<li><p>Originally by ' . $track_list['track_details']->original . '</p></li>'; ?>

        </ul>
        <?php echo $this->typography->auto_typography($track_list['track_details']->notes); ?>
    </div>

    <?php if ($track_list['track_details']->lyrics): ?>
        <h3>Lyrics</h3>
        <div>
            <?php echo $this->typography->auto_typography($track_list['track_details']->lyrics); ?>
        </div>
    <?php endif; ?>


    <?php if ($track_list['track_details']->tab): ?>
        <h3>Guitar</h3>
        <div>
            <?php echo $this->typography->auto_typography($track_list['track_details']->tab); ?>

        </div>
    <?php endif; ?>


    <?php if(count($track_list['available']) > 0): ?>
    <h3>Available on</h3>
    <div>
        <ul>
            <?php foreach ($track_list['available'] as $available): ?>

                <li><p><a href="<?php echo site_url('database/discography/' . $available->slug . '/' . $available->album_id); ?>"><?php echo $available->album; ?> by <?php echo $available->display; ?></a>
                        <em>(<?php echo $available->label; ?> - <?php echo $available->release_date; ?>)</em>
                    </p>
                </li>
            <?php endforeach; ?>          
        </ul>

    </div>
    <?php endif; ?>


</div>