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
    <h2><?php echo $artist_details->display . ': ' . $section; ?></h2>

    <?php
    if ($artist_details->image) {
        $image_props = array(
            'src' => MEDIA_HOST . '/sleeves/' . $artist_details->image,
            'alt' => $artist_details->display,
            'width' => '200',
            'height' => '200',
            'title' => $artist_details->display
        );
        ?>

        <div class="imagebox_right">
            <?php echo img($image_props); ?>
            <p><?php echo $artist_details->display; ?></p>
        </div>
        <?php
    }
    ?>    

    <div>
        <p><?php echo $this->typography->auto_typography($artist_details->notes); ?></p>
    </div>


</div>