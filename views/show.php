<?php ?>

<div id="content_left">
    <h2><?php echo date('jS F Y', strtotime($show['show_details']->date)) ?>: <?php echo htmlentities($artist_details->display); ?> at <?php echo htmlentities($show['show_details']->venue); ?></h2>
    <?php echo $this->typography->auto_typography($show['show_details']->notes); ?>


    <?php if (count($showimages) > 0) echo '<p><a href="#showpics">Pictures</a></p>'; ?>

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
    <?php
    echo '<ul id="showpics">';
    if (count($showimages) > 0) {
        foreach ($showimages as $showimage) {
            $caption = '';
            if ($showimage->caption !== '') {
                $caption .= $showimage->caption . ' ';
            }
            if ($showimage->photographer !== '') {
                $caption .= 'by ' . $showimage->photographer;
            }

            $thumb = substr($showimage->filename, 0, strrpos($showimage->filename, '.')) . '_tn' . substr($showimage->filename, strrpos($showimage->filename, '.'));
            $this->firephp->log($thumb);
            echo '<li><a href="http://media.fullofwishes.co.uk/images/pictures-wishes/' . $showimage->filename . '" title="' . $showimage->caption . ' by ' . $showimage->photographer . '" rel="prettyPhoto[gallery' . $show['show_details']->show_id . ']"><img src="http://media.fullofwishes.co.uk/images/pictures-wishes/t/' . $thumb . '" width="150" height="150" alt="' . $showimage->caption . '" /></a></li>';
        }


        if ($flickrimages) {

            foreach ($flickrimages as $image) {
                echo '<li><a href="' . $image['url'] . '" title="' . $image['caption'] . '<a target=\'_blank\' href=\'' . $image['link'] . '\'> view on flickr</a>" rel="prettyPhoto[gallery' . $show['show_details']->show_id . ']"><img src="' . $image['thumb'] . '" width="150" height="150" alt="' . $image['caption'] . '" /></a></li>';
            }
        }
    }
    echo '</ul>';
    ?>

</div>
