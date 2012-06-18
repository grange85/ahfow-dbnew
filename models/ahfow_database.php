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
class Ahfow_database extends MY_Model {

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

    function get_artist_details($artist) {


        $this->firephp->log($artist);

        if (is_numeric($artist)) {
            $sql = 'select * from artists where artist_id = ' . $artist;
        } else {
            $artist = str_replace(' ', '_', str_replace('&', 'and', trim(strtolower(urldecode($artist)))));
            $sql = 'select * from artists where slug like "' . $artist . '"';
        }
        $query = $this->db->query($sql);
        $this->firephp->log($query->result());
        if ($query->num_rows !== 1) {
            return FALSE;
        } else {
            $output = $query->result();
            return $output[0];
        }
    }

}
