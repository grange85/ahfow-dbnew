<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Survey extends MY_Controller {

    private $_surveyConfig = array(
        array(
            'artist' => 'galaxie_500',
            'artist_id' => 1,
            'albums' => array(1, 6, 8, 13, 194, 200),
        ),
        array(
            'artist' => 'luna',
            'artist_id' => 2,
            'albums' => array(24, 26, 28, 30, 34, 36, 152, 192),
        ),
        array(
            'artist' => 'damon_and_naomi',
            'artist_id' => 3,
            'albums' => array(72, 75, 77, 79, 157, 197, 238),
        ),
        array(
            'artist' => 'dean_and_britta',
            'artist_id' => 7,
            'albums' => array(186, 211, 237),
        )
    );

    private function _checkminimum() {
        return false;
    }

    function __construct() {
        parent::__construct();
        $this->load->model('ahfow_database');
        if ($this->session->userdata('logged_in')) {
            $this->username = $this->session->userdata('username');
        } else {
            $this->username = NULL;
        }
    }

    public function index() {
        
    }

    public function surveyform() {
        $args = func_get_args();
        $data = array();
        $i = 0;
        if ($this->input->cookie('ahfowsurvey'))
            redirect('survey/completed/2');
        foreach ($this->_surveyConfig as $artist) {
            $data['artists'][$i]['artist_details'] = $this->ahfow_database->get_artist_details($artist['artist_id']);
            $data['artists'][$i]['discography'] = $this->ahfow_database->get_discography($artist['artist_id'], $artist['albums']);
            $data['artists'][$i]['tracklist'] = $this->ahfow_database->get_track_list('artisttracks', $artist["artist_id"]);
            $i++;
        }
        $data['ages'] = $this->ahfow_database->get_survey_ages();
//        $this->firephp->log($data['ages']);
        $data['section'] = 'survey';
        $data['page_title'] = 'survey form';
        $data['message_code'] = FALSE;
        $this->firephp->log(uniqid('ahfow2012'));
        $this->load->view('survey', $data);
//            $this->load->view('wrapper/sidebar', $data);
    }

    public function process() {
        $_complete = $this->ahfow_database->add_survey($_POST);
        if ($_complete) {
            redirect('survey/completed/2');
        } else {
            redirect('survey/completed/1');
        }
    }

    public function completed() {
        $args = func_get_args();
        $args[0] = (is_numeric($args[0])) ? $args[0] : 1;
        if (!$this->input->cookie('ahfowsurvey'))
            redirect('survey/surveyform');
        $data['message'] = 'Survey completed';
        $data['message_code'] = $args[0];
        $data['section'] = 'survey';
        $data['page_title'] = 'survey complete';
        $this->load->view('survey', $data);
    }

    public function view() {
        $args = func_get_args();
        $artists = array('galaxie_500' => 1, 'luna' => 2, 'damon_and_naomi' => 3, 'dean_and_britta' => 7);
        $args[0] = (is_numeric($args[0])) ? $args[0] : 2012;
        switch ($args[1]) {
            case 'galaxie_500':
            case 'luna':
            case 'damon_and_naomi' :
            case 'dean_and_britta' :
                $sqlalbums = 'SELECT s.album_id, a.album, x.display, count( s.album_id ) AS votes, ASIN, sleeve
                    FROM survey_albums s 
                    INNER JOIN albums a ON s.album_id = a.album_id 
                    INNER JOIN artists x ON x.artist_id = a.artist_id 
                    INNER JOIN new_survey_votes sv ON sv.vote_id = s.vote_id 
                    WHERE s.artist_id = ' . $artists[$args[1]] . '1 AND YEAR( sv.survey_year ) = \'2012\' 
                    GROUP BY ( s.album_id ) 
                    ORDER BY votes DESC, album ASC';

                $sqltracks = 'SELECT s.track_id, t.track, count( s.track_id ) AS votes 
                    FROM survey_tracks s 
                    INNER JOIN tracks t ON t.track_id = s.track_id 
                    INNER JOIN artists x ON x.artist_id = s.artist_id 
                    INNER JOIN new_survey_votes sv ON sv.vote_id = s.vote_id 
                    WHERE s.artist_id = 1 AND YEAR( sv.survey_year ) = \'2012\' 
                    GROUP BY (s.track_id) 
                    HAVING votes >= 1 
                    ORDER BY votes DESC, track ASC';

                break;
            default:

                break;
        }
    }

}