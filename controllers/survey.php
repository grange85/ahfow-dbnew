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
            'albums' => array(72, 75, 77, 79, 157, 197, 214, 238),
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
        if (!SURVEY_OPEN) {
            redirect('survey/closed');
        }
        $args = func_get_args();
        $data = array();
        $i = 0;
        if ($this->input->cookie('ahfowsurvey'))
            redirect('survey/completed/1');
        foreach ($this->_surveyConfig as $artist) {
            $data['artists'][$i]['artist_details'] = $this->ahfow_database->get_artist_details($artist['artist_id']);
            $data['artists'][$i]['discography'] = $this->ahfow_database->get_discography($artist['artist_id'], $artist['albums']);
            $data['artists'][$i]['tracklist'] = $this->ahfow_database->get_track_list('artisttracks', $artist["artist_id"]);
            $i++;
        }
        $data['ages'] = $this->ahfow_database->get_survey_ages();
        $data['section'] = 'survey';
        $data['page_title'] = 'survey form';
        $data['message_code'] = FALSE;
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

    public function closed() {
        $args = func_get_args();
        $data['message'] = 'Survey closed';
        $data['section'] = 'survey';
        $data['page_title'] = 'survey closed';
        $this->load->view('survey_closed', $data);
    }

    public function noresults() {
        $data['message'] = 'Survey closed';
        $data['section'] = 'survey';
        $data['page_title'] = 'survey closed';
        $this->load->view('survey_closed', $data);
    }

    public function view() {
        $args = func_get_args();
        $artists = array('galaxie_500' => 1, 'luna' => 2, 'damon_and_naomi' => 3, 'dean_and_britta' => 7);
        if (!is_numeric($args[0]) || ($args[0] > SURVEY_CURRENT && $args[1] !== 'peek')) {
            redirect('survey/view/' . SURVEY_CURRENT);
        }
        
        $args[0] = (is_numeric($args[0])) ? $args[0] : SURVEY_CURRENT;
//        if ($args[0] < 2003 || $args[0] == 2011) {
//            redirect('survey/noresults');
//        }
        $data['page_title'] = 'Survey results ' . $args[0];
        $data['survey_summary'] = $this->ahfow_database->get_survey_summary($args[0]);

        $data['artists'] = $artists;
        $data['year'] = $args[0];

        foreach ($artists as $key => $value) {
            $data['artist'][$key]['artist'] = $key;
            $data['artist'][$key]['artist_id'] = $value;
            $data['artist'][$key]['artist_details'] = $this->ahfow_database->get_artist_details($value);
            $data['artist'][$key]['artist_results'] = $this->ahfow_database->get_survey_results($value, $args[0]);
        }


        $this->load->view('surveyresults', $data);
        $this->load->view('wrapper/footer');
    }

}
