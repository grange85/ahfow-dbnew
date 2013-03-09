
<?php $this->load->helper('richtext_helper');?>

<div id="content_left">
    <h2><?php echo htmlentities($artist_details->display) . ' - ' . htmlentities($disc['details']->album); ?></h2>

    <div class="clearfix">
    <?php
    if ($disc['details']->sleeve) {
        $image_props = array(
            'src' => MEDIA_HOST . '/sleeves/' . $disc['details']->sleeve,
            'alt' => htmlentities($disc['details']->album) . 'sleeve',
            'width' => '200',
            'height' => '200',
            'title' => htmlentities($disc['details']->album) . 'sleeve'
        );
        ?>

        <div class="imagebox_right">
            <?php echo img($image_props); ?>
        </div>
        <?php
    }
    ?>


        <p><em><?php echo htmlentities($disc['details']->format) . ' - ' . htmlentities($disc['details']->label) . ' (' . $disc['details']->release_date . ')'; ?></em></p>
        <?php echo '<div class="richtext">' . process_text($this->typography->auto_typography($disc['details']->notes),TRUE,TRUE) . '</div>'; ?>
    </div>
    <h4">Tracks</h4>
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