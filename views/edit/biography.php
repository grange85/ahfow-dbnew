<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// put your code here




/* End of file biography.php */
/* Location: $(filePath} */

$this->load->helper('form');
?>





<div id="content_left">
    <?php echo form_open(); ?>
    <h2>EDIT / <?php echo htmlentities($artist_details->display) . ': ' . $section; ?></h2>

    <?php
    if ($artist_details->image) {
        $image_props = array(
            'src' => MEDIA_HOST . '/sleeves/' . $artist_details->image,
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

    <div>
        <?php echo htmlspecialchars_decode($artist_details->notes); ?>


        <?php
        $formdata = array(
            'name' => 'biography',
            'class' => 'mceEditor',
            'style' => 'width: 100%;',            
            'value' => htmlspecialchars_decode($artist_details->notes)
        );

        echo form_textarea($formdata);
        ?>
        <?php echo $testcontent; ?>
    </div>

        <?php
        echo form_hidden('artist_id', $artist_details->artist_id);
        echo form_reset('reset', 'Reset');
        echo form_submit('submit', 'Submit');
        echo form_close();
        ?>
</div>


