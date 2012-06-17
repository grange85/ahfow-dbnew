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

    function get_discography($artist_id) {
        $sql = 'select album_id, album, artist_id, UNIX_TIMESTAMP(release_date) as timestamp, DATE_FORMAT(release_date, \'%Y\') as release_date, version, label, album_types.type from albums inner join album_types on album_types.type_id = albums.type where artist_id = ' . $artist_id . ' order by albums.type ASC, release_date ASC';
//        $query = $this->db->query('select album_id, album, artist_id, UNIX_TIMESTAMP(release_date) as timestamp, DATE_FORMAT(release_date, \'%Y\') as release_date, version, label, album_types.type from albums inner join album_types on album_types.type_id = albums.type where artist_id = ' . $artist_id . ' and (include=1 or albums.type > 2) group by albums.type ASC, release_date ASC');
        $query = $this->db->query($sql);
        $this->firephp->log($sql);

        foreach ($query->result() as $item) {
            $output[$item->type][] = $item;
        }
        $this->firephp->log($output);
        return $output;
    }

    function get_disc($disc_id) {
        $sql = 'select display as artist, album_id, album, albums.artist_id, albums.notes, sleeve, UNIX_TIMESTAMP(release_date) as timestamp, DATE_FORMAT(release_date, \'%Y\') as release_date, release_date as full_release_date, version, type, volume_id, ASIN, albumsort, label, format, albums.mbid, albums.wikipedia, include from albums inner join artists on artists.artist_id = albums.artist_id where album_id = ' . $disc_id;
        $query = $this->db->query($sql);
        $this->firephp->log($query->result());
        $output = $query->result();
        $this->firephp->log($output[0]);
        return $output[0];
    }

    function get_volumes($artist_id, $category) {
        
    }

    function artist_lookup($artist) {

        $artist = str_replace(' ', '', strtolower(urldecode($artist)));
        $this->firephp->log($artist);


        switch ($artist) {
            case 'galaxie500':
                return array('artist_id' => 1, 'display' => 'Galaxie 500', 'slug' => $artist);
                break;
            case 'luna':
                return array('artist_id' => 2, 'display' => 'Luna', 'slug' => $artist);
                break;
            case 'damonandnaomi':
            case 'damon&naomi':
                return array('artist_id' => 3, 'display' => 'Damon & Naomi', 'slug' => $artist);
                break;
            case 'deanwareham':
                return array('artist_id' => 5, 'display' => 'Dean Wareham', 'slug' => $artist);
                break;
            case 'deanandbritta':
            case 'dean&britta':
                return array('artist_id' => 7, 'display' => 'Dean & Britta', 'slug' => $artist);
                break;
            default:
                return false;
        }
    }

}
