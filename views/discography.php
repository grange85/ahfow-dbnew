

<div id="content_left">
    <h2><?php echo htmlentities($artist_details->display) . ': ' . $section; ?></h2>



    <?php foreach (array_keys($releases) as $type): ?>
        <h3><a name="<?php echo urlencode($type) ?>"></a><?php echo $type; ?></h3>
        <?php
        foreach ($releases[$type] as $release) :
            echo '<h4>' . $release['volume']->album . ' (' . $release['volume']->release_date . ')</h4><ul>';
            foreach ($release['volume']->releases as $item) :
                $this->firephp->log($item);
                ?>
                <li><p><a href="<?php echo site_url('database/discography/' . $artist_details->slug . '/' . $item->album_id); ?>"><?php echo htmlentities($item->album); ?> (<?php echo $item->label . ' - ' . $item->release_date; ?>)</a>
                    <?php
                    if ($item->type !== $type) echo ': <em>' . strtolower($item->type) . '</em>';?>
                    
                    
                    </p></li>
                <?php
            endforeach;
            echo '</ul>';
        endforeach;
        ?>


    </ul><p class="backtotop"><a href="#top">Back to the top</a></p>

<?php endforeach; ?>




</div>