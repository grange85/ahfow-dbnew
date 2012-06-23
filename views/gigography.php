<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// put your code here




/* End of file gigography.php */
?>
<div id="content_left">
    <h2><?php echo $artist_details->display; ?> shows from <?php echo $year; ?></h2>
    <ul>
        <?php foreach ($show_list['list'] as $show): ?>
            <li><p><a href="<?php echo site_url('/database/gigography/' . $artist_details->slug . '/show/' . $show->show_id); ?>"><?php echo date('jS F Y', strtotime($show->date)) . ' @ ' . $show->venue ?></a></p></li>
        <?php endforeach; ?>
    </ul>
</div>