<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Musicbrainz extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ahfow_database');
        $this->load->model('ahfow_musicbrainz');
        if ($this->session->userdata('logged_in')) {
            $this->username = $this->session->userdata('username');
        } else {
            $this->username = NULL;
        }
    }

    public function index() {
        $args = func_get_args();
        $data = array();
        if (count($args) === 0) {
            $data['section'] = 'home';
            $data['artist_list'] = $this->ahfow_database->get_artists();
        } else {
            redirect('database/biography/' . $args[0], 'location');
        }
        if (ENVIRONMENT === 'production') {
            $this->output->cache(DEFAULT_CACHE_LENGTH);
        }
        $data['page_title'] = 'Home';
        $data['user'] = $this->username;
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
            if (count($args) === 1) {
                $selected_view = 'discography';
                $data['discography'] = $this->ahfow_database->get_discography($data['artist_details']->artist_id);
                $data['page_title'] = ucfirst($data['section']) . ': ' . $data['artist_details']->artist;
            } else {
                $selected_view = 'mbdisc';
                $data['disc'] = $this->ahfow_musicbrainz->get_disc($args[1]);
                $this->firephp->log($data['disc']);
                $data['page_title'] = ucfirst($data['section']) . ': ' . $data['disc']->{'artist-credit'}->{'name-credit'}->artist->name . ' - ' . $data['disc']->title;
                if (!$data['disc']) {
                    show_404();
                }
            }
        }
        $this->firephp->log($data);
        if (ENVIRONMENT === 'production') {
            $this->output->cache(DEFAULT_CACHE_LENGTH);
        }
        $data['user'] = $this->username;
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
            redirect('database');
        } else {
            $data['section'] = 'biography';
            $data['artist_details'] = $this->ahfow_database->get_artist_details($args[0]);
            $data['page_title'] = ucfirst($data['section']) . ': ' . $data['artist_details']->artist;
            if (!$data['artist_details']) {
                show_404();
            }
        }
        if (ENVIRONMENT === 'production') {
            $this->output->cache(DEFAULT_CACHE_LENGTH);
        }
        $this->firephp->log($data);
        $data['user'] = $this->username;
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
        $data['user'] = $this->username;

        if (count($args) === 0) {
            show_404();
        }

        $data['artist_details'] = $this->ahfow_database->get_artist_details($args[0]);
        if (count($args) === 1 || (count($args) > 1 && $args[1] !== 'show')) {

            if (count($args) > 1) {

                if (is_numeric($args[1])) {

                    if (!checkdate('01', '01', $args[1]))
                        show_404();
                    $data['year'] = $args[1];
                } else if ($args[1] === 'upcoming') {
                    $data['year'] = 'upcoming';
                } else {
                    show_404();
                }
            } else {
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
                redirect('database/gigography/' . $data['artist_details']->slug . '/' . $data['year'], 'location');
            }
            $selected_view = 'gigography';
            $data['page_title'] = ucfirst($data['section']) . ': ' . $data['artist_details']->artist . ': ' . $data['year'];

            if ($data['year'] === 'upcoming') {
                $data['show_list'] = $this->ahfow_database->get_shows_list($data['artist_details']->artist_id, null, null, TRUE);
            } else {
                $data['show_list'] = $this->ahfow_database->get_shows_list($data['artist_details']->artist_id, $data['year']);
            }
        } else if (count($args) > 2 && $args[1] === 'show') {
            $selected_view = 'show';
            $data['show'] = $this->ahfow_database->get_show_details($args[2]);
            $data['page_title'] = ucfirst($data['section']) . ': ' . $data['artist_details']->artist . ': ' . $data['show']['show_details']->date . ' - ' . $data['show']['show_details']->venue;
        } else {
            show_404();
        }

        if (ENVIRONMENT === 'production') {
            $this->output->cache(DEFAULT_CACHE_LENGTH);
        }
        $this->firephp->log($data);
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
                $details = $this->ahfow_database->get_track_list($args[0], $args[1]);
                $data['list'] = $details['list'];
                $data['az'] = $details['az'];

                $selected_view = 'list';
                $data['section'] = 'tracks';
                $data['page_title'] = 'A-Z of tracks - ' . ucfirst($data['key']);
                break;
            case 'covers':
            case 'guitar':
                $details = $this->ahfow_database->get_track_list($args[0]);
                $data['list'] = $details['list'];
                $data['az'] = $details['az'];
                $selected_view = 'list';
                $data['section'] = $args[0];
                $data['page_title'] = 'A-Z of ' . $args[0];
                break;
            case is_numeric($args[0]):
                if (isset($args[1])) {
                    if ($args[1] === 'shows') {
                        $data['track_details'] = $this->ahfow_database->get_track_details($args[0]);
                        $data['show_list'] = $this->ahfow_database->get_shows_list(NULL, NULL, $args[0]);
                        $data['section'] = 'lists';
                        $selected_view = 'gigography';
                        $data['page_title'] = 'Shows where ' . $data['track_details']['track_details']->track . ' was played live';
                    } else {
                        redirect(site_url('database/track/' . $args[0]));
                    }
                } else {

                    // track details
                    $details = $this->ahfow_database->get_track_details($args[0]);
                    $data['track_details'] = $details['track_details'];
                    $data['az'] = $details['az'];
                    $data['available'] = $details['available'];


                    $data['key'] = substr($data['track_details']->tracksort, 0, 1);

                    $selected_view = 'track';
                    $data['section'] = 'track';
                    $data['page_title'] = ucfirst($data['section']) . ': ' . $data['track_details']->track;
                }
                break;
            default:
                show_404();
        }
        $this->firephp->log($data);

        if (ENVIRONMENT === 'production') {
            $this->output->cache(DEFAULT_CACHE_LENGTH);
        }
        $data['user'] = $this->username;
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
        $data['page_title'] = 'Lists';
        $data['user'] = $this->username;

        if (count($args) > 0) {
            if ($args[0] !== 'albums') {
                show_404();
            } else {
                $details = $this->ahfow_database->get_track_list($args[0]);
                $data['az'] = $details['az'];
                $data['list'] = $details['list'];
                $selected_view = 'list';
                $data['section'] = $args[0];
                $data['page_title'] = 'List of albums';
            }
        } else {

            $selected_view = 'list';
        }
        if (ENVIRONMENT === 'production') {
            $this->output->cache(DEFAULT_CACHE_LENGTH);
        }
        $this->firephp->log($data);
        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/menu', $data);
        $this->load->view($selected_view, $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }

}

