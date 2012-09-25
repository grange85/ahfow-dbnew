<?php $this->load->helper('musicbrainz_helper');?>

<div id="content_left">
    <h2><?php echo htmlentities($disc->{'artist-credit'}->{'name-credit'}->artist->name) . ' - ' . htmlentities($disc->title); ?></h2>





    <div class="clearfix">
        <?php
        if ($disc->ahfow->sleeve) {
            $image_props = array(
                'src' => MEDIA_HOST . '/sleeves/' . $disc->ahfow->sleeve,
                'alt' => htmlentities($disc->title) . 'sleeve',
                'width' => '200',
                'height' => '200',
                'title' => htmlentities($disc->title) . 'sleeve'
            );
            ?>


            <div class="imagebox_right">
                <?php echo img($image_props); ?>
                <p><?php echo htmlentities($disc->title) . ' - ' . htmlentities($disc->{'artist-credit'}->{'name-credit'}->artist->name); ?></p>
            </div>
            <?php
        }
        ?>


        <p><em><?php echo htmlentities($disc->{'medium-list'}->medium->format) . ' - ' . htmlentities($disc->{'label-info-list'}->{'label-info'}->label->name) . ' (' . $disc->date . ')'; ?></em></p>
        <p><?php echo $this->typography->auto_typography($disc->ahfow->notes); ?></p>
    </div>
    <h4">Tracks</h4>
    <div>
        <table class="discography">
            <tr><th>Name</th><th>Time</th><th>Notes</th></tr>
            <?php foreach ($disc->{'medium-list'}->medium->{'track-list'}->track as $tracks): ?>
                <?php $this->firephp->log($tracks); ?>

                <tr><td><a href="<?php echo site_url('musicbrainz/track/' . $tracks->recording['id']); ?>"><?php echo htmlentities($tracks->recording->title); ?></a></td>
                <td><?php echo format_milliseconds($tracks->recording->length); ?></td>
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