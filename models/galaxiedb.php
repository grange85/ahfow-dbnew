<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Galaxiedb extends MY_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    function get_artists() {

        $query = $this->db->get('artists');
        $this->firephp->log($query->result());
        return $query->result();
    }
    
    function get_discography($artist_id = null) {
        
        $query = "select album_id, album, artist_id, UNIX_TIMESTAMP(release_date) as timestamp, DATE_FORMAT(release_date, '%Y') as release_date, version, label, album_types.type from albums inner join album_types on album_types.type_id = albums.type where artist_id = $artist_id and (include=1 or albums.type > 2) order by albums.type ASC, release_date ASC";
        
    }

    
    function get_volumes($artist_id, $category){
        
    }
}
