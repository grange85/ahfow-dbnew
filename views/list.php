
<div id="content_left">

<?php if ($section !== 'lists'):?>
    <h2>A-Z of <?php echo strtolower($section);?> <?php if ($section === 'tracks') echo ': ' . strtoupper($key); ?></h2>

    
    <?php if ($section === 'albums'):?>
        <ul>
            <?php $current = '';
            foreach ($track_list['list'] as $album): ?>
                <?php if ($current !== $album->sort) {
                    if ($current !=='') echo '</ul><p class="backtotop"><a href="#top">Back to the top</a></p>';
                    $current = $album->sort;
                    echo '<h4><a name="' . strtolower($current) . '"></a>' . strtoupper($current) . '</h4><ul>';

                }?>
            
                <li><p><a href="<?php echo site_url('database/discography/'. $album->slug . '/' . $album->album_id); ?>"><?php echo htmlentities($album->album) . ' - ' . htmlentities($album->display) ; ?></a>
                        <?php echo '<em>(' . $album->year . ' - ' . $album->label . ')</em>'; ?>
                    </p>
                </li>
            <?php endforeach; ?>          

        </ul>
    
    
    <?php else:?>
        <ul>
            <?php $current = '';
            foreach ($track_list['list'] as $track): ?>
                <?php if ($current !== $track->sort && $section !== 'tracks' ) {
                    if ($current !=='') echo '</ul><p class="backtotop"><a href="#top">Back to the top</a></p>';
                    $current = $track->sort;
                    echo '<h4><a name="' . strtolower($current) . '"></a>' . strtoupper($current) . '</h4><ul>';

                }?>
                <li><p><a href="<?php echo site_url('database/track/' . $track->track_id); ?>"><?php echo htmlentities($track->track); ?></a>
                        <?php if ($track->author): ?>
                            <?php if ($track->author !== 'Krukowski/Wareham/Yang') echo '<em>(' . htmlentities($track->author) . ')</em>'; ?>
                        <?php endif; ?>
                    </p>
                </li>
            <?php endforeach; ?>          

        </ul>
    <?php endif;?>
    
<?php else:?>
    <h2>Lists</h2>
    <ul>
        <li><p><a href="<?php echo site_url('database/track/az'); ?>" title="A-Z of tracks">Tracks</a></p></li>
        <li><p><a href="<?php echo site_url('database/track/covers'); ?>" title="A-Z of cover versions">Covers</a></p></li>
        <li><p><a href="<?php echo site_url('database/track/guitar'); ?>" title="A-Z of guitar">Guitar</a></p></li>
      
    </ul>
    
    
<?php endif;?>
    

</div>