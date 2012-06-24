
<div id="content_left">
    <h2>A-Z of tracks: <?php echo strtoupper($key); ?></h2>

    <div>
        <ul>
            <?php foreach ($track_list['list'] as $track): ?>

                <li><p><a href="<?php echo site_url('database/track/' . $track->track_id); ?>"><?php echo $track->track; ?></a>
                        <?php if ($track->author): ?>
                            <?php if ($track->author !== 'Krukowski/Wareham/Yang') echo '<em>(' . $track->author . ')</em>'; ?>
                        <?php endif; ?>
                    </p>
                </li>
            <?php endforeach; ?>          

        </ul>
    </div>


</div>