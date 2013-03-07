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
class Ahfow_flickr extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $params = array('api_key' => FLICKR_API_KEY, 'secret' => FLICKR_API_SECRET, 'die_on_error' => FALSE);
        $this->load->library('phpflickr', $params);
    }

    function get_photos($type, $id) {

        switch ($type) {
            case 'show':
                $tag = 'ahfow:showid=' . $id;
                break;
            case 'volume':
                $tag = 'ahfow:volumeid=' . $id;
                break;
            default :
                return FALSE;
        }
        $args = array('tags' => $tag, 'tag_mode' => 'any');
        $results = $this->phpflickr->photos_search($args);
        $this->firephp->log($results);
        $this->firephp->log($args);
        
        if ($results['total'] > 0) {
            $i = 0;
            foreach($results['photo'] as $photo) {
                $photos_info = $this->phpflickr->photos_getInfo($photo['id']);
                $return[$i]['url'] = $this->phpflickr->buildPhotoUrl($photos_info['photo'], 'medium');
                $return[$i]['caption'] = $this->phpflickr->buildPhotoUrl($photos_info['photo'], 'medium');
//                $this->firephp->log($photos_url);
//                $this->firephp->log($photos_info['photo']['id']);
                $this->firephp->log($photos_info);
            }
        }
        
    }

}

