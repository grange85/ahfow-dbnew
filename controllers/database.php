<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Database extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('ahfow_database');
    }

    public function index($artist) {
        $head_data = array();
        $menu_data = array();
        $sidebar_data = array();
        $data = array();

        $data['artists'] = $this->ahfow_database->get_artist_details($artist);
        $head_data['props']['shorttitle'] = $data['artists']->display;
        $head_data['props']['title'] = 'A Head Full of Wishes: ' . $head_data['props']['shorttitle'];
        $this->load->view('wrapper/header', $head_data);
        $this->load->view('wrapper/menu', $menu_data);
        $this->load->view('artists', $data);
        $this->load->view('wrapper/sidebar', $sidebar_data);
        $this->load->view('wrapper/footer');
    }

    public function discography() {
        $args = func_get_args();
        if (count($args) < 1) {
            show_404();
        }
        $data = array();
        $data['section'] = 'Discography';
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

        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/menu', $data);
        $this->load->view($selected_view, $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }

    public function biography() {
        $args = func_get_args();
        if (count($args) < 1) {
            show_404();
        }
        $data = array();
        $data['section'] = 'Biography';
        $data['artist_details'] = $this->ahfow_database->get_artist_details($args[0]);

        if (!$data['artist_details']) {
            show_404();
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
        $data['section'] = 'Gigography';
        $this->firephp->log($args);

        if (count($args) === 0) {
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
        } else if (count($args) === 3 && $args[1] === 'show') {
            $selected_view = 'show';
            $data['show'] = $this->ahfow_database->get_show_details($args[2]);
            $this->firephp->log($data);
        }

        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/menu', $data);
        $this->load->view($selected_view, $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }

}
