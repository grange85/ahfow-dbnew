<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// put your code here




/* End of file gigography.php */
?>
<div id="content_left">
    <h2><?php echo date('jS F Y', strtotime($show['show_details']->date)) ?>: <?php echo htmlentities($artist_details->display); ?> at <?php echo htmlentities($show['show_details']->venue); ?></h2>
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
