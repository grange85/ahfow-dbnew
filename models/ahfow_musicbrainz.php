<?php

/**
 * A Head Full of Wishes database access class
 *
 * This class creates, reads, updates and deletes content from the 
 * A Head Full of Wishes database
 *
 * @package	AHFoW
 * @author	Andy Aldridge <andy@grange85.co.uk>
 * @link	http://www.fullofwishes.co.uk
 */
class Ahfow_musicbrainz extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_disc($disc_id) {
        $sql = 'select 
                    notes, 
                    sleeve, 
                    mbid
                from 
                    albums
                where 
                    album_id = ' . $disc_id;
        $this->firephp->log($sql);
        $query = $this->db->query($sql);
        $disc = $query->result();
        $url = 'http://musicbrainz.org/ws/2/release/' . $disc[0]->mbid . '?inc=artists%2Blabels%2Brecordings%2Brelease-groups%2Bdiscids';
        $xml = file_get_contents($url);
        $this->firephp->log($url);

    
        $disc_details = simplexml_load_string($xml);
        $release = $disc_details->release;
        $extra = $release->addChild('ahfow');
        $extra->addChild('notes',$disc[0]->notes);
        $extra->addChild('ahfowid',$disc_id);
        $extra->addChild('sleeve',$disc[0]->sleeve);
        if ($release->carthorse) {
            $this->firephp->log('yes');
        } else {
            $this->firephp->log('no');
        }
        $this->firephp->log($release);
        return $release;
    }

}

