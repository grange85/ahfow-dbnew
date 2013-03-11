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
            $bln_artist = TRUE;
        } else {
            $query = $this->db->query('select * from artists where artist_id between 1 and 7');
            $bln_artist = FALSE;
        }

        $output = $query->result();
        if ($bln_artist) {
            return $output[0];
        } else {
            return $output;
        }
    }

    function get_releases($artist_id) {

        $sql = 'select 
                    volume_id, 
                    album, 
                    artist_id, 
                    first_release_year as release_date, 
                    album_types.type 
                from 
                    release_group inner join album_types on album_types.type_id = release_group.type 
                where 
                    artist_id = ' . $artist_id . ' ';
        $sql .= ' order by 
                    release_group.type ASC, 
                    release_date ASC';
        $query = $this->db->query($sql);
        $i = 0;
        foreach ($query->result() as $item) {

            $output[$item->type][$i]['volume'] = $item;
            $output[$item->type][$i]['volume']->releases = $this->get_discography($artist_id, NULL, $item->volume_id);
            $i++;
        }
//        $this->firephp->log($output);
        return $output;
    }

    function get_discography($artist_id, $survey = NULL, $volume_id = NULL) {

        $sql = 'select 
                    album_id, 
                    album, 
                    artist_id, 
                    UNIX_TIMESTAMP(release_date) as timestamp, 
                    DATE_FORMAT(release_date, \'%Y\') as release_date, 
                    version, 
                    label, 
                    include,
                    album_types.type 
                from 
                    albums inner join album_types on album_types.type_id = albums.type 
                where 
                    artist_id = ' . $artist_id . ' ';
        if ($survey !== NULL) {
            $sql .= ' and album_id in (' . implode(',', $survey) . ') ';
        }

        if ($volume_id !== NULL) {
            $sql .= ' and volume_id  = ' . $volume_id . ' ';
        }

        $sql .= 'order by 
                    release_date ASC';
        $query = $this->db->query($sql);

        foreach ($query->result() as $item) {
            if ($volume_id !== NULL) {
                $output[] = $item;
            } else {
                $output[$item->type][] = $item;
            }
        }
        return $output;
    }

    function get_disc($disc_id, $full = TRUE) {
        $sql = 'select 
                    display as artist, 
                    album_id, 
                    album, 
                    albums.artist_id, 
                    slug, 
                    albums.notes, 
                    sleeve, 
                    UNIX_TIMESTAMP(release_date) as timestamp,
                    DATE_FORMAT(release_date, \'%Y\') as release_date, 
                    release_date as full_release_date, 
                    version, 
                    type, 
                    volume_id, 
                    ASIN, 
                    albumsort, 
                    label, 
                    format, 
                    albums.mbid, 
                    albums.wikipedia, 
                    include 
                from 
                    albums inner join artists on artists.artist_id = albums.artist_id 
                where 
                    album_id = ' . $disc_id;
        $query = $this->db->query($sql);
        $disc = $query->result();
        if (count($disc) === 0)
            return false;

        $output['details'] = $disc[0];

        $sql = 'select 
                    tracks.track_id, 
                    track, 
                    author, 
                    lyrics, 
                    notes, 
                    version, 
                    tab, 
                    tracksort, 
                    original, 
                    position, 
                    releasenotes 
                from 
                    tracks 
                        inner join album_track on album_track.track_id = tracks.track_id 
                where 
                    album_id = ' . $disc_id . ' 
                order by 
                    position';
        $query = $this->db->query($sql);
        $output['tracks'] = $query->result();

        $sql = 'select 
                    album_id, 
                    album, 
                    label, 
                    UNIX_TIMESTAMP(release_date) as timestamp, 
                    DATE_FORMAT(release_date, \'%Y\') as release_date, 
                    type, 
                    artist_id 
                from 
                    albums 
                where 
                    (volume_id = ' . $output['details']->volume_id . ') 
                    and (album_id <> ' . $disc_id . ')';
        $query = $this->db->query($sql);
        $output['others'] = $query->result();

        return $output;
    }

    function get_volumes($artist_id, $category) {
        
    }

    function get_artist_details($artist) {



        if (is_numeric($artist)) {
            $sql = 'select * from artists where artist_id = ' . $artist;
        } else {
            $artist = str_replace(' ', '_', str_replace('&', 'and', trim(strtolower(urldecode($artist)))));
            $sql = 'select * from artists where slug like "' . $artist . '"';
        }
        $query = $this->db->query($sql);
        if ($query->num_rows !== 1) {
            return FALSE;
        } else {
            $output = $query->result();
            return $output[0];
        }
    }

    function get_shows_list($artist_id = NULL, $year = NULL, $track_id = NULL, $upcoming = FALSE) {
        $sql = 'select 
                    artists.artist_id, 
                    display as artist, 
                    UNIX_TIMESTAMP(date) as timestamp, 
                    date, 
                    shows.show_id, 
                    venue, 
                    shows.notes, 
                    (select count(*) from pictures where link_id = shows.show_id and linktype_id = 1) as pictures,
                    (select count(*) from setlists where show_id = shows.show_id) as setlists, 
                    slug,
                    radio';
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
            if ($upcoming) {
                $sql .= ' and (shows.date > curdate()-1) ';
            } else {
                $sql .= ' and DATE_FORMAT(date,\'%Y\') = ' . $year;
            }
        }


        $sql .= " order by date ";

//        $this->firephp->log($sql);
        $query = $this->db->query($sql);

        $return['list'] = $query->result();

        if (!$track_id) {
            $sql = "select distinct DATE_FORMAT(date, '%Y') as year from shows where artist_id = $artist_id order by date";
            $query = $this->db->query($sql);
            $return['years'] = $query->result();
            $return['debug'] = 'debug: ' . $track_id;
        }

        return $return;
    }

    function get_show_details($show_id) {
        $sql = "select 
                    show_id, 
                    UNIX_TIMESTAMP(date) as timestamp, 
                    date, 
                    shows.artist_id, 
                    display as artist, 
                    shows.notes, 
                    radio, 
                    cancelled, 
                    lastfm, 
                    confirmed, 
                    venue,
                    slug,
                    YEAR(date) as year 
                from 
                    shows 
                        inner join artists on artists.artist_id = shows.artist_id 
                where 
                    show_id = $show_id";
        $query = $this->db->query($sql);
        $rows = $query->result();
        if (!isset($rows[0]))
            return FALSE;

        $return['show_details'] = $rows[0];

        $sql = "select setlists.track_id, track, setlists.notes, tracks.author, position from tracks inner join setlists on setlists.track_id = tracks.track_id where show_id = $show_id order by position";
        $query = $this->db->query($sql);
        $return['setlist'] = $query->result();
        return $return;
    }

    function get_show_images($show_id) {
        $sql = "select
                    picture_id,
                    filename,
                    photographer,
                    source,
                    caption,
                    type
                from pictures
                where
                    link_id = $show_id and linktype_id = 1";

        $this->firephp->log($sql);
        $query = $this->db->query($sql);
        $rows = $query->result();
        $this->firephp->log($rows);
        return $rows;
    }

    function get_track_details($track_id) {
        $sql = "select 
                    track_id, 
                    track, 
                    author, 
                    lyrics, 
                    notes, 
                    version, 
                    tab, 
                    tracksort, 
                    original, 
                    (select count(*) from setlists where track_id = $track_id) as plays 
                from 
                    tracks 
                where 
                    track_id = $track_id";
        $query = $this->db->query($sql);
        $rows = $query->result();
        $return['track_details'] = $rows[0];

        $sql = "select 
                    albums.album_id, 
                    albums.album,
                    albums.release_date,
                    albums.label,
                    artists.display,
                    artists.slug
                from 
                    albums 
                        inner join album_track on album_track.album_id = albums.album_id 
                        inner join artists on artists.artist_id = albums.artist_id 
                where 
                    album_track.track_id = $track_id";

        $query = $this->db->query($sql);

//        $rows = $query->result();
        $return['available'] = $query->result();
        $return['az'] = $this->get_az();
//        $return['played'] = $this->get_shows_list(NULL, NULL, $track_id);

        return $return;
    }

    function get_az($type = NULL) {
        $azsql = 'select DISTINCT UPPER(LEFT(tracksort,1)) as sort from tracks';
        if ($type) {
            if ($type === 'covers')
                $azsql .= ' where author <> \'\' and author not like \'%yang%\' and author not like \'%wareham%\'';
            if ($type === 'guitar')
                $azsql .= ' where tab <> \'\' ';
            if ($type === 'albums')
                $azsql = 'select DISTINCT UPPER(LEFT(albumsort,1)) as sort from albums';
        }
        $azsql .= ' order by sort';
        $az = $this->db->query($azsql);
        return $az->result();
    }

    function get_track_list($type, $keyword = NULL) {
        switch ($type) {
            case 'guitar':
                $sql = 'select 
                            track_id, 
                            track, 
                            lyrics, 
                            tab, 
                            author, 
                            UPPER(LEFT(tracksort, 1)) as sort 
                        from 
                            tracks 
                        where 
                            tab <> \'\' order by tracksort';
                break;
            case 'az':
                $sql = 'select 
                            track_id, 
                            track, 
                            author, 
                            LOWER(LEFT(tracksort, 1)) as sort 
                        from 
                            tracks 
                        where 
                            LOWER(LEFT(tracksort, 1)) like \'' . $keyword . '\' 
                        order by 
                            tracksort';
                break;
            case 'albums':
                $sql = 'select 
                            a.album_id, 
                            a.album, 
                            b.display,
                            b.slug,
                            a.label, 
                            a.release_date, 
                            LOWER(LEFT(albumsort,1)) as sort,
                            YEAR(release_date) as year,
                            b.artist_id 
                        from 
                            albums a, 
                            artists b 
                        where 
                            (a.albumsort like \'' . $keyword . '%\') 
                            and (a.artist_id = b.artist_id) 
                        order by 
                            albumsort';
                break;

            case 'artisttracks' :
                $sql = 'select distinct
                            tracks.track_id, 
                            track, 
                            author, 
                            LOWER(LEFT(tracksort, 1)) as sort 
                        from 
                            tracks 
                        inner join album_track on tracks.track_id = album_track.track_id
                        inner join albums on album_track.album_id = albums.album_id
                        where 
                            artist_id = ' . $keyword . ' 
                        order by 
                            tracksort';
                break;

            case "covers":
                $sql = 'select 
                            track_id, 
                            track, 
                            lyrics, 
                            tab, 
                            concat(\'written by \', author,\' // originally by \', ifnull(original,\'unknow\')) as author,
                            UPPER(LEFT(tracksort, 1)) as sort 
                        from 
                            tracks 
                        where 
                            author <> \'\' and author not like \'%yang%\' and author not like \'%wareham%\' 
                            and (tracksort like \'' . $keyword . '%\') 
                        order by 
                            tracksort';
                break;
            default:
                return false;
        }
        $return['az'] = $this->get_az($type);

        $query = $this->db->query($sql);
        $return['list'] = $query->result();
        return $return;
    }

    function set_biography($formdata) {


        $data = array(
            'display' => $formdata['display'],
            'notes' => htmlspecialchars($formdata['biography']),
            'wikipedia' => $formdata['wikipedia'],
            'image' => $formdata['image'],
            'mbid' => $formdata['mbid'],
            'website' => $formdata['website']
        );
        $where = 'artist_id = ' . $formdata['artist_id'];
        $str = $this->db->update_string('artists', $data, $where);
//        $this->firephp->log($where);
//        $this->firephp->log($str);
        $this->db->query($str);
    }

    function add_survey($formdata) {

        $check = $this->db->query('select count(*) as count from new_survey_votes where vote_id = "' . $formdata['frmId'] . '"');
        $check2 = $check->result();
        if ($check2[0]->count > 0)
            return FALSE;
        $_bands = array(1 => 'galaxie_500', 2 => 'luna', 3 => 'damon_and_naomi', 7 => 'dean_and_britta');
        $_person_data = array(
            'vote_id' => $formdata['frmId'],
            'name' => $formdata['frmName'],
            'email' => $formdata['frmEmail'],
            'age' => $formdata['frmAge'],
            'country' => $formdata['frmCountry'],
            'comments' => $formdata['frmComments'],
            'survey_year' => date('Y-00-00')
        );
        $this->db->insert('new_survey_votes', $_person_data);

        foreach ($_bands as $_band_id => $_band) {


            if ($formdata['frm-' . $_band . '-tracks'] !== '') {
                foreach (explode(',', $formdata['frm-' . $_band . '-tracks']) as $_track_id) {

                    $_track_data = array(
                        'vote_id' => $formdata['frmId'],
                        'artist_id' => $_band_id,
                        'track_id' => $_track_id
                    );

                    $this->db->insert('survey_tracks', $_track_data);
                }
            }

            if (is_numeric($formdata[$_band . '-albumvote'])) {
                $_album_data = array(
                    'vote_id' => $formdata['frmId'],
                    'artist_id' => $_band_id,
                    'album_id' => $formdata[$_band . '-albumvote']
                );
                $this->db->insert('survey_albums', $_album_data);
            }
        }

        $expires = strtotime('2013-01-01') - time();
//        var_dump($expires);

        $this->firephp->log('Expires: ' . $expires);

        $cookie = array(
            'name' => 'ahfowsurvey',
            'value' => $formdata['frmId'],
            'expire' => $expires
        );

        $this->input->set_cookie($cookie);

        $this->load->library('email');

        $this->email->from('andy@fullofwishes.co.uk', 'AHFoW Survey');
        $this->email->to('andy@fullofwishes.co.uk');
        $this->email->subject('Survey: ' . $formdata['frmId']);
        $this->email->message(print_r($_POST, true));
        $this->email->send();


        return TRUE;
    }

    function get_survey_ages() {
        $query = $this->db->query('select age_id, age_range from survey_ages');
        $i = 0;
        foreach ($query->result() as $row) {
            $return[$i]['age_id'] = $row->age_id;
            $return[$i]['age_range'] = $row->age_range;
            $i++;
        }
        return $return;
    }

    function get_survey_results($artist_id, $year) {

        $sqlalbums = 'SELECT s.album_id, a.album, x.display, count( s.album_id ) AS votes, ASIN, sleeve
                    FROM survey_albums s 
                    INNER JOIN albums a ON s.album_id = a.album_id 
                    INNER JOIN artists x ON x.artist_id = a.artist_id 
                    INNER JOIN new_survey_votes sv ON sv.vote_id = s.vote_id 
                    WHERE s.artist_id = ' . $artist_id . ' AND YEAR( sv.survey_year ) = \'' . $year . '\' 
                    GROUP BY ( s.album_id ) 
                    ORDER BY votes DESC, album ASC';

        $sqltracks = 'SELECT s.track_id, t.track, count( s.track_id ) AS votes 
                    FROM survey_tracks s 
                    INNER JOIN tracks t ON t.track_id = s.track_id 
                    INNER JOIN artists x ON x.artist_id = s.artist_id 
                    INNER JOIN new_survey_votes sv ON sv.vote_id = s.vote_id 
                    WHERE s.artist_id = ' . $artist_id . ' AND YEAR( sv.survey_year ) = \'' . $year . '\' 
                    GROUP BY (s.track_id) 
                    HAVING votes >= 1 
                    ORDER BY votes DESC, track ASC';

        $albums = $this->db->query($sqlalbums);
        $tracks = $this->db->query($sqltracks);
        $return['albums'] = $albums->result();
        $return['tracks'] = $tracks->result();
        return $return;
    }

    function get_survey_summary($year) {
        $sqlResponses = 'SELECT count(*) as count from new_survey_votes where YEAR(survey_year) = \'' . $year . '\'';
        $sqlCountries = 'SELECT country, count(country) as count FROM `new_survey_votes` where country NOT LIKE \'%Select%\' and YEAR(survey_year) = \'' . $year . '\' group by country order by count DESC';
        $sqlAges = 'SELECT sa.age_range, sv.age, count( sv.age ) AS count FROM new_survey_votes sv LEFT JOIN survey_ages sa ON sv.age = sa.age_id WHERE age <> 1 and YEAR(survey_year) = \'' . $year . '\' GROUP BY sv.age ORDER BY sv.age ASC ';
        $responses = $this->db->query($sqlResponses)->result();
        $return['responses'] = $responses[0]->count;
        $return['countries'] = $this->db->query($sqlCountries)->result();
        $return['ages'] = $this->db->query($sqlAges)->result();
//        $this->firephp->log($return);
        return $return;
    }

}

