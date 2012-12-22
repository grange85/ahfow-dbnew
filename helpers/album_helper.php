<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// put your code here

function amazon_iframe($asin, $store) {

    switch ($store) {
        case 'uk':
            $urlbase = 'http://rcm-uk.amazon.co.uk';
            $id = 'aheadfullofwi-21';
            $o = 2;
            break;
        case 'us':
            $urlbase = 'http://rcm.amazon.com';
            $id = 'aheadfullofwi-20';
            $o = 1;
            break;
    }

    $src = $urlbase . '/e/cm?lt1=_blank&bc1=000000&IS2=1&bg1=FFFFFF&fc1=000000&lc1=0000FF&t=' . $id . '&o=' . $o . '&p=8&l=as4&m=amazon&f=ifr&ref=ss_til&asins=' . $asin;


    
    return '<iframe src="' . $src . '" style="width:120px;height:240px;" scrolling="no" marginwidth="0" marginheight="0" frameborder="0"></iframe>';
}

/* End of file album_helper.php */
