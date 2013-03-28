<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// put your code here




/* End of file biography.php */
/* Location: $(filePath} */
?>

<div id="content_left">
    <h2><?php echo htmlentities($artist_details->display) . ': ' . $section; ?></h2>

    <?php
    $basepath = MEDIA_HOST . '/0' . $artist_details->artist_id . '-' . $artist_details->slug . '/';
    if ($artist_details->image) {
        $image_props = array(
            'src' => $basepath . 'pictures/' . $artist_details->image,
            'alt' => htmlentities($artist_details->display),
            'width' => '200',
            'height' => '200',
            'title' => htmlentities($artist_details->display)
        );
        ?>

        <div class="imagebox_right">
            <?php echo img($image_props); ?>
            <p><?php echo htmlentities($artist_details->display); ?></p>
        </div>
        <?php
    }
    ?>    

    <div class="clearfix">
        <?php echo htmlspecialchars_decode($artist_details->notes); ?>
    </div>

    <?php
    echo '<ul id="pics" class="clearfix">';
    if (count($images) > 0) {
        foreach ($images as $image) {
            $caption = '';
            if ($image->caption !== '') {
                $caption .= $image->caption . ' ';
            }
            if (!empty($image->photographer)) {
                $caption .= 'by ' . $image->photographer;
            }

            $thumb = substr($image->filename, 0, strrpos($image->filename, '.')) . '_tn' . substr($image->filename, strrpos($image->filename, '.'));
            $this->firephp->log($thumb);
            echo '<li><a href="' . $basepath . 'pictures/' . $image->filename . '" title="' . $caption . '" rel="prettyPhoto[gallery]"><img src="' . $basepath . 'pictures/' . $thumb . '" width="150" height="150" alt="' . $caption . '" /></a></li>';
        }
    }
    echo '</ul>';
    ?>

</div>