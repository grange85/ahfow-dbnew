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
    <h3>Artist:</h3> <p><?php
    echo form_input('artist', $artist_details->display);
    ?></p>    
    <h3>Image:</h3> <p><?php
    echo form_input('image', $artist_details->image);
    ?></p>    
    <h3>Notes:</h3>
    <div>

        <?php
        $notesdata = array(
            'name' => 'biography',
            'class' => 'mceEditor',
            'style' => 'width: 100%;',
            'value' => htmlspecialchars_decode($artist_details->notes)
        );

        echo form_textarea($notesdata);
        ?>
    <h3>Website:</h3> <p><?php
    echo form_input('website', $artist_details->website);
    ?></p>    
    <h3>Wikipedia:</h3> <p><?php
    echo form_input('wikipedia', $artist_details->wikipedia);
    ?></p>    
    <h3>Musicbrainz:</h3> <p><?php
    echo form_input('mbid', $artist_details->mbid);
    ?></p>    

    </div>

    <?php
    echo form_hidden('artist_id', $artist_details->artist_id);
    echo form_reset('reset', 'Reset');
    echo form_submit('submit', 'Submit');
    echo form_close();
    ?>
</div>


