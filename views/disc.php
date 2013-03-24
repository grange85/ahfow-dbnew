
<?php $this->load->helper('richtext_helper'); ?>

<div id="content_left">
    <h2><?php echo htmlentities($artist_details->display) . ' - ' . htmlentities($disc['details']->album); ?></h2>

    <div class="clearfix">
        <?php
        if ($disc['details']->sleeve) {
            $basepath = MEDIA_HOST . '/0' . $artist_details->artist_id . '-' . $artist_details->slug . '/sleeves/';
            $thumb = substr($disc['details']->sleeve, 0, strrpos($disc['details']->sleeve, '.')) . '_tn' . substr($disc['details']->sleeve, strrpos($disc['details']->sleeve, '.'));
            $this->firephp->log($thumb);
            $image_props = array(
                'src' => $basepath . $thumb,
                'alt' => htmlentities($disc['details']->album) . ' sleeve',
                'width' => '150',
                'height' => '150',
                'title' => htmlentities($disc['details']->album) . ' sleeve'
            );
            ?>

            <div class="imagebox_right">
                <?php echo '<a href="' . $basepath . $disc['details']->sleeve . '" rel="prettyPhoto[gallery_' . $disc['details']->volume_id . ']">' . img($image_props) . '</a>'; ?>
            </div>
            <?php
        }
        ?>


        <p><em><?php echo htmlentities($disc['details']->format) . ' - ' . htmlentities($disc['details']->label) . ' (' . $disc['details']->release_date . ')'; ?></em></p>
        <?php echo '<div class="richtext">' . $this->typography->auto_typography(process_text($disc['details']->notes), TRUE, TRUE) . '</div>'; ?>
    </div>
    <h4>Tracks</h4>
    <div>
        <table class="discography">
            <tr><th>Name</th><th>Author</th><th>Notes</th></tr>
            <?php foreach ($disc['tracks'] as $tracks): ?>

                <tr><td><a href="<?php echo site_url('database/track/' . $tracks->track_id); ?>"><?php echo htmlentities($tracks->track); ?></a></td>
                    <td><?php if ($tracks->author !== '') echo '<em>' . htmlentities($tracks->author) . '</em>'; ?></td>
                    <td><?php if ($tracks->releasenotes != '') echo '<em>' . htmlentities($tracks->releasenotes) . '</em>'; ?></td>
                    </p>
                </tr>
            <?php endforeach; ?>          
        </table>
    </div>



    <?php
    if (count($images) > 0) {
        $basepath = MEDIA_HOST . '/0' . $artist_details->artist_id . '-' . $artist_details->slug . '/sleeves/';
        echo '<ul id="showpics" class="clearfix">';
        foreach ($images as $image) {
            $caption = '';
            if ($image->caption !== '') {
                $caption .= $image->caption . ' ';
            }

            $thumb = substr($image->filename, 0, strrpos($image->filename, '.')) . '_tn' . substr($image->filename, strrpos($image->filename, '.'));
            $this->firephp->log($thumb);
            echo '<li><a href="' . $basepath . $image->filename . '" title="' . $image->caption . '" rel="prettyPhoto[gallery_' . $disc['details']->volume_id . ']"><img src="' . $basepath . $thumb . '" width="150" height="150" alt="' . $image->caption . '" /></a></li>';
        }
        echo '</ul>';
    }
    ?>




<?php if (count($disc['others']) > 0): ?>
        <h4>Other versions</h4>
        <div>
            <ul>
    <?php foreach ($disc['others'] as $other): ?>

                    <li><p><a href="<?php echo site_url('database/discography/' . $disc['details']->slug . '/' . $other->album_id); ?>"><?php echo htmlentities($other->album); ?></a>
                            <em>(<?php echo $other->label; ?> - <?php echo $other->release_date; ?>)</em>
                        </p>
                    </li>
    <?php endforeach; ?>          
            </ul>
        </div>
<?php endif; ?>

</div>