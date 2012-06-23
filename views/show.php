<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// put your code here




/* End of file gigography.php */
?>
<div id="content_left">
    <h2><?php echo date('jS F Y', strtotime($show['show_details']->date)) ?>: <?php echo $artist_details->display; ?> at <?php echo $show['show_details']->venue; ?></h2>
    <?php echo $this->typography->auto_typography($show['show_details']->notes); ?>

    <?php if (count($show['setlist']) > 0): ?>
        <h3>Setlist</h3>
        <ul>
            <?php foreach ($show['setlist'] as $track): ?>

                <li><p><a href=""><?php echo $track->track; ?></a></p></li>

            <?php endforeach; ?>
        </ul>

    <?php endif; ?>
</div>
