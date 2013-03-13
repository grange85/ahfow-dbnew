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
        $CI = & get_instance();
        $path = $CI->config->item('cache_path');
        $cache_path = ($path == '') ? APPPATH . 'cache/' : $path;
        $this->phpflickr->enableCache('fs', $cache_path, 7200);
    }

    function get_tagged_list($type = 'show') {
        $per_page = 500;
        $more = TRUE;
        $page = 1;
        $arr_return = array();
        $arr_results = array();
        while ($more) {
            $results = $this->phpflickr->machinetags_getValues('ahfow', $type . 'id', $per_page, $page);
            $arr_results = array_merge($arr_results, $results['values']['value']);
            $this->firephp->log(count($results['values']['value']));
            if (count($results['values']['value']) !== $per_page) {
                $more = FALSE;
            } else {
                $page++;
            }
        }
        foreach ($arr_results as $value) {

            $this->firephp->log($value);
            array_push($arr_return, $value['_content']);
        }
        return $arr_return;
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
//        $this->firephp->log($results);
//        $this->firephp->log($args);

        if ($results['total'] > 0) {
            $i = 0;
            foreach ($results['photo'] as $photo) {
                $photos_info = $this->phpflickr->photos_getInfo($photo['id']);
                $photos_sizes = $this->phpflickr->photos_getSizes($photo['id']);
//                $this->firephp->log($photos_sizes);
                $return[$i]['url'] = $this->phpflickr->buildPhotoUrl($photos_info['photo'], 'medium');
                $return[$i]['thumb'] = $this->phpflickr->buildPhotoUrl($photos_info['photo'], 'largesquare');
                $return[$i]['link'] = 'http://www.flickr.com/photos/' . $photos_info['photo']['owner']['nsid'] . '/' . $photos_info['photo']['id'];
                $return[$i]['caption'] = $photos_info['photo']['title'] . ' by ' . $photos_info['photo']['owner']['username'];
                $i++;
            }
            return $return;
        }
    }

}

