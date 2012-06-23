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

    function get_artists($artist_id = NULL) {

        if (is_numeric($artist_id)) {
            $query = $this->db->query('select * from artists where artist_id = ' . $artist_id);
        } else {
            $query = $this->db->get('artists');
        }

        $output = $query->result();
        $this->firephp->log($output[0]);
        return $output[0];
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

    function get_disc($disc_id, $full = TRUE) {
        $sql = 'select display as artist, album_id, album, albums.artist_id, slug, albums.notes, sleeve, UNIX_TIMESTAMP(release_date) as timestamp, DATE_FORMAT(release_date, \'%Y\') as release_date, release_date as full_release_date, version, type, volume_id, ASIN, albumsort, label, format, albums.mbid, albums.wikipedia, include from albums inner join artists on artists.artist_id = albums.artist_id where album_id = ' . $disc_id;
        $query = $this->db->query($sql);
        $disc = $query->result();
        if (count($disc) === 0)
            return false;

        $output['details'] = $disc[0];

        $sql = 'select tracks.track_id, track, author, lyrics, notes, version, tab, tracksort, original, position, releasenotes from tracks inner join album_track on album_track.track_id = tracks.track_id where album_id = ' . $disc_id . ' order by position';
        $query = $this->db->query($sql);
        $output['tracks'] = $query->result();

        $sql = 'select album_id, album, label, UNIX_TIMESTAMP(release_date) as timestamp, DATE_FORMAT(release_date, \'%Y\') as release_date, type, artist_id from albums where (volume_id = ' . $output['details']->volume_id . ') and (album_id <> ' . $disc_id . ')';
        $query = $this->db->query($sql);
        $output['others'] = $query->result();



        return $output;
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

    function get_shows_list($artist_id = null, $year = null, $track_id = null) {
        $sql = 'select artists.artist_id, display as artist, UNIX_TIMESTAMP(date) as timestamp, date, shows.show_id, venue, shows.notes, radio';
        if ($track_id)
            $sql .= ', track_id';
        $sql .= ' from shows ';
        $sql .= ' inner join artists on artists.artist_id = shows.artist_id ';
        if ($track_id)
            $sql .= 'inner join setlists on setlists.show_id = shows.show_id ';
        $sql .= 'where cancelled <> 1 ';

        if ($track_id)
            $sql .= 'and (track_id = ' . $track_id . ')';
        else {
            $sql .= ' and shows.artist_id = ' . $artist_id;
            $sql .= ' and DATE_FORMAT(date,\'%Y\') = ' . $year;
        }
        $sql .= " order by date ";
        $this->firephp->log($sql);
        $query = $this->db->query($sql);

        $return['list'] = $query->result();

        $sql = "select distinct DATE_FORMAT(date, '%Y') as year from shows where artist_id = $artist_id order by date";
        $query = $this->db->query($sql);
        $return['years'] = $query->result();


        $this->firephp->log($return);
        return $return;
    }

    function get_show_details($show_id) {
        $sql = "select show_id, UNIX_TIMESTAMP(date) as timestamp, date, shows.artist_id, display as artist, shows.notes, radio, cancelled, lastfm, confirmed, venue, YEAR(date) as year from shows inner join artists on artists.artist_id = shows.artist_id where show_id = $show_id";
        $query = $this->db->query($sql);
        $rows = $query->result();
        $return['show_details'] = $rows[0];

        $sql = "select setlists.track_id, track, setlists.notes, position from tracks inner join setlists on setlists.track_id = tracks.track_id where show_id = $show_id order by position";
        $query = $this->db->query($sql);
        $return['setlist'] = $query->result();
        $this->firephp->log($return);
        return $return;
    }

}
