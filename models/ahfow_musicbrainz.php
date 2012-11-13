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

    
    /*
     * @assert (1) == 3
     * 
     */
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
        $xml = $this->_checkmbcache($disc[0]->mbid, 'release');
//        $url = 'http://musicbrainz.org/ws/2/release/' . $disc[0]->mbid . '?inc=artists%2Blabels%2Brecordings%2Brelease-groups%2Bdiscids';
//        $xml = file_get_contents($url);
//        $this->firephp->log($GLOBALS);


        $disc_details = simplexml_load_string($xml);
        $release = $disc_details->release;
        $extra = $release->addChild('ahfow');
        $extra->addChild('notes', $disc[0]->notes);
        $extra->addChild('ahfowid', $disc_id);
        $extra->addChild('sleeve', $disc[0]->sleeve);
        $this->firephp->log($release);
        $this->firephp->log('mbapitine:' . $this->_mbapitime);
        return $release;
    }

    function _checkmbcache($mbid, $type) {
        $path = $type . '/' . $mbid;
        if (file_exists(APPPATH . 'mbcache/' . $path)) {
            $this->firephp->log(time() - filemtime(APPPATH . 'mbcache/' . $path));
            if (time() - filemtime(APPPATH . 'mbcache/' . $path) <= MB_CACHE_LENGTH) {
                $this->firephp->log('getting file from cache');
                return file_get_contents(APPPATH . 'mbcache/' . $path);
            }
        }
        $this->firephp->log('making api call');
        $this->firephp->log(time() - $_SESSION['mbapitime']);
        while (time() - $_SESSION['mbapitime'] < 60) {
            $this->firephp->log(time() - $_SESSION['mbapitime']);
        }
        $url = 'http://musicbrainz.org/ws/2/' . $path . '?inc=artists%2Blabels%2Brecordings%2Brelease-groups%2Bdiscids';
        $_SESSION['mbapitime'] = time();
        $this->firephp->log('mbapitine:' . $_SESSION['mbapitime']);
        $file = file_get_contents($url);
        if (!is_dir(APPPATH . 'mbcache/' . $type)) {
            $this->firephp->log(APPPATH . 'mbcache/' . $type);
            mkdir(APPPATH . 'mbcache/' . $type);
        }
        file_put_contents(APPPATH . 'mbcache/' . $path, $file);
        return $file;
    }

}

