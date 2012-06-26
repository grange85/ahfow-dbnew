
<div id="content_left">
    <h2>A-Z of <?php echo strtolower($section);?> <?php if ($section === 'Tracks') echo ': ' . strtoupper($key); ?></h2>

        <ul>
            <?php $current = '';
            foreach ($track_list['list'] as $track): ?>
                <?php if ($current != $track->sort) {
                    if ($current !=='') echo '</ul><p class="backtotop"><a href="#top">Back to the top</a></p>';
                    $current = $track->sort;
                    echo '<h4><a name="' . strtolower($current) . '"></a>' . $current . '</h4><ul>';

                }?>
                <li><p><a href="<?php echo site_url('database/track/' . $track->track_id); ?>"><?php echo $track->track; ?></a>
                        <?php if ($track->author): ?>
                            <?php if ($track->author !== 'Krukowski/Wareham/Yang') echo '<em>(' . $track->author . ')</em>'; ?>
                        <?php endif; ?>
                    </p>
                </li>
            <?php endforeach; ?>          

        </ul>


</div>