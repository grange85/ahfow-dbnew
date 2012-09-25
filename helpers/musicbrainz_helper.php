<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// put your code here


function format_milliseconds($input) {

    $input = floor($input / 1000);
    $seconds = $input % 60;
    $input = floor($input / 60);
    $minutes = $input % 60;
    $input = floor($input / 60);
    return str_pad($minutes,2,'0',STR_PAD_LEFT) . ':' . str_pad($seconds,2,'0',STR_PAD_LEFT);
}

/* End of file musicbrainz_helper.php */
/* Location: $(filePath} */