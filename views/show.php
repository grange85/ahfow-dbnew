<?php
?>
<div id="content_left">
    <h2><?php echo date('jS F Y', strtotime($show['show_details']->date)) ?>: <?php echo htmlentities($artist_details->display); ?> at <?php echo htmlentities($show['show_details']->venue); ?></h2>
    <?php
    $this->firephp->log($showimages);
    if (count($showimages) > 0) {
        echo '<ul class="bxslider">';
        foreach($showimages as $showimage) {
            $caption = '';
            if ($showimage->caption !== '') {$caption .= $showimage->caption . ' ';}
            if ($showimage->photographer !== '') {$caption .= 'by ' . $showimage->photographer;}
            
        
            echo '<li><img src="http://media.fullofwishes.co.uk/images/pictures-wishes/' . $showimage->filename . '" title="' . $caption .  '"/></li>';
        }
        echo '</ul>';
    }
    
    
    ?>
    <?php echo $this->typography->auto_typography($show['show_details']->notes); ?>
    
    


    <?php if (count($show['setlist']) > 0): ?>
        <h3>Setlist</h3>
        <table class="gigography">
            <tr><th>Name</th><th>Author</th><th>Notes</th></tr>
            
            <?php foreach ($show['setlist'] as $track): ?>

                <tr><td><a href="<?php echo site_url('database/track/' . $track->track_id); ?>"><?php echo htmlentities($track->track); ?></a></td>
                            <td><?php if ($track->author !== '') echo '<em>' . htmlentities($track->author) . '</em>'; ?></td>
                            <td><?php if ($track->notes != '') echo '<em>' . htmlentities($track->notes) . '</em>'; ?></td>
                </li>
            <?php endforeach; ?>
        </table>

    <?php endif; ?>
</div>
