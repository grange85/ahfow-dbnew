<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Database extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ahfow_database');
    }

    public function index() {
        $args = func_get_args();
        $data = array();
        if (count($args) === 0) {
            $data['section'] = 'home';
            $data['artist_list'] = $this->ahfow_database->get_artists();
        } else {
//            $data['section'] = 'discography';
//            $data['artist_details'] = $this->ahfow_database->get_artist_details($args[0]);
            redirect('database/biography/' . $args[0], 'location');
        }
        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/menu', $data);
        $this->load->view('home', $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }

    public function discography() {
        $args = func_get_args();
        $data = array();
        if (count($args) < 1) {
            show_404();
        } else {
            $data['section'] = 'discography';
            $data['artist_details'] = $this->ahfow_database->get_artist_details($args[0]);
            if (!$data['artist_details']) {
                show_404();
            }
            $this->firephp->log($args);
            if (count($args) === 1) {
                $selected_view = 'discography';
                $data['discography'] = $this->ahfow_database->get_discography($data['artist_details']->artist_id);
            } else {
                $selected_view = 'disc';
                $data['disc'] = $this->ahfow_database->get_disc($args[1]);
                if (!$data['disc']) {
                    show_404();
                }
            }
        }

        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/menu', $data);
        $this->load->view($selected_view, $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }

    public function biography() {
        $args = func_get_args();
        $data = array();
        if (count($args) === 0) {
            show_404();
        } else {
            $data['section'] = 'biography';
            $data['artist_details'] = $this->ahfow_database->get_artist_details($args[0]);

            if (!$data['artist_details']) {
                show_404();
            }
        }
        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/menu', $data);
        $this->load->view('biography', $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }

    public function gigography() {
        $args = func_get_args();
        $data = array();
        $data['section'] = 'gigography';
        $this->firephp->log($args);

        if (count($args) === 0) {
            show_404();
            //gigography home page
        } else {
            $data['artist_details'] = $this->ahfow_database->get_artist_details($args[0]);
            if (!$data['artist_details']) {
                show_404();
            }
        }



        if (count($args) === 1 || (count($args) > 1 && $args[1] !== 'show')) {
            $selected_view = 'gigography';

            if (count($args) > 1) {
                if (!checkdate('01', '01', $args[1]))
                    $args[1] = '1995';
                $data['year'] = $args[1];
            } else {
                $selected_view = 'gigography';
                switch ($data['artist_details']->artist_id) {
                    case 1:
                        $data['year'] = '1987';
                        break;
                    case 2:
                        $data['year'] = '1992';
                        break;
                    case 3:
                        $data['year'] = '1996';
                        break;
                    case 5:
                        $data['year'] = '2003';
                        break;
                    case 7:
                        $data['year'] = '2003';
                        break;
                }
            }

            $data['show_list'] = $this->ahfow_database->get_shows_list($data['artist_details']->artist_id, $data['year']);
        } else if (count($args) > 2 && $args[1] === 'show') {
            $selected_view = 'show';
            $data['show'] = $this->ahfow_database->get_show_details($args[2]);
            $this->firephp->log($data);
        } else {
            show_404();
        }

        $this->firephp->log($data);
        if (ENVIRONMENT === 'production' || ENVIRONMENT === 'testing') {
            $this->output->cache(DEFAULT_CACHE_LENGTH);
        }
        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/menu', $data);
        $this->load->view($selected_view, $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }

    public function track() {
        $args = func_get_args();
        $data = array();

        switch ($args[0]) {
            case 'az':
                //az list of tracks
                if (count($args) < 2)
                    $args[1] = 'a';
                if (!(ctype_alpha($args[1]) && strlen($args[1]) === 1))
                    $args[1] = 'a';
                $args[1] = strtolower($args[1]);
                $data['key'] = $args[1];
                $data['track_list'] = $this->ahfow_database->get_track_list($args[0], $args[1]);
                $selected_view = 'list';
                $data['section'] = 'tracks';
                break;
            case 'covers':
            case 'guitar':
                $data['track_list'] = $this->ahfow_database->get_track_list($args[0]);
                $selected_view = 'list';
                $data['section'] = $args[0];
                break;
            case is_numeric($args[0]):
                // track details
                $data['track_list'] = $this->ahfow_database->get_track_details($args[0]);
                $data['key'] = substr($data['track_list']['track_details']->tracksort, 0, 1);

                $selected_view = 'track';
                $data['section'] = 'track';
                if (!$data['track_list']) {
                    show_404();
                }
                break;
            default:
                show_404();
        }

        $this->firephp->log($data);
        if (ENVIRONMENT === 'production' || ENVIRONMENT === 'testing') {
            $this->output->cache(DEFAULT_CACHE_LENGTH);
        }
        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/menu', $data);
        $this->load->view($selected_view, $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }

    public function lists() {
        $args = func_get_args();
        $data = array();
        $data['section'] = 'lists';

        if (count($args) > 0) {
            if ($args[0] !== 'albums') {
                show_404();
            } else {
                $data['track_list'] = $this->ahfow_database->get_track_list($args[0]);
                $selected_view = 'list';
                $data['section'] = $args[0];
            }
            
            
        } else {
            
            $selected_view = 'list';
        }
        $this->firephp->log($data);
        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/menu', $data);
        $this->load->view($selected_view, $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }

}

