<?php

/* 
 * Turns formatted text into html
 * The following will be converted
 * Asterisked rows to lists
 * Html links
 * Internal links
 */

// put your code here

function process_text($text) {
    //replace astersiked rows as unordered lists
    $return = preg_replace("/_([^_]*)_/",'<em>$1</em>',$text);
    $return = preg_replace("/(\<\/ul\>\n(.*)\<ul\>*)+/","",preg_replace("/\*+(.*)?/i","<ul><li>$1</li></ul>",$return));
    $return = preg_replace("/\[([^|]*)\|([^\]]*)]/", "<a href=\"$2\">$1</a>", $return);
    
    
    return $return;
}



/* End of file richtext_helper.php */
/* Location: $(filePath} */