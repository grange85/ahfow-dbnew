<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// put your code here




/* End of file gigography.php */
                $this->firephp->log($tagged_list);
?>
<?php $this->load->helper('richtext_helper'); ?>
<div id="content_left">
    <?php if (isset($artist_details)): ?>
        <h2><?php echo htmlentities($artist_details->display); ?> shows from <?php echo $year; ?></h2>
    <?php else: ?>
        <h2>Shows where <a href="<?php echo site_url('database/track/' . $track_details['track_details']->track_id); ?>"><?php echo htmlentities($track_details['track_details']->track); ?></a> was played live</h2>
    <?php endif; ?>
    <table class="gigography">
        <col width="30%"/>
        <col width="20%"/>
        <col width="40%"/>
        <col width="5%"/>
        <col width="5%"/>
       
        <tr><th>Date</th><th>Artist</th><th>Venue</th><th>Setlist</th><th>Pictures</th></tr>
            <?php foreach ($show_list['list'] as $show): 
                ?>

                <tr>
                    <td><a href="<?php echo site_url('/database/gigography/' . $show->slug . '/show/' . $show->show_id); ?>"><?php echo date('jS F Y', strtotime($show->date)) ?></a></td>
                    <td><?php echo $show->artist;?></td>
                    <td><?php echo $show->venue;?></td>
                    <td><?php echo ($show->setlists > 0)?'yes': '';?></td>
                    <td><?php echo ($show->pictures > 0 | in_array($show->show_id, $tagged_list, FALSE)) ?'yes': '';?></td>

                </tr>   
            <?php endforeach; ?>
    </table>
</div>
