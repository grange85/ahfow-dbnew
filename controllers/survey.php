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
            'albums' => array(72, 75, 77, 78, 79, 157, 197, 238),
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
            redirect('survey/completed');
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
            redirect('survey/completed');
        } else {
            $data['message'] = 'There was a problem';
            $data['message_code'] = 1;
            $data['section'] = 'survey';
            $data['page_title'] = 'survey error';
            $this->load->view('survey', $data);
        }
    }

    public function completed() {
        if (!$this->input->cookie('ahfowsurvey'))
            redirect('survey/surveyform');
        $data['message'] = 'Survey completed';
        $data['message_code'] = 2;
        $data['section'] = 'survey';
        $data['page_title'] = 'survey complete';
        $this->load->view('survey', $data);
    }

}