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

    public function discography($artist = 'galaxie_500', $album = NULL) {
        $head_data = array();
        $menu_data = array();
        $sidebar_data = array();
        $data = array();

        if (!is_numeric($album)) {
            $selected_view = 'discography';
            $artist_details = $this->ahfow_database->get_artist_details($artist);
            $this->firephp->log($album);
            if (!$artist_details) {
                show_404();
            }
            $data['discography'] = $this->ahfow_database->get_discography($artist_details->artist_id);
            $data['slug'] = $artist_details->slug;
            $menu_data['slug'] = $data['slug'];
            $head_data['props']['shorttitle'] = $artist_details->display;
        } else {
            $selected_view = 'disc';
            $data['disc'] = $this->ahfow_database->get_disc($album);            
            $menu_data['slug'] = $data['disc']['details']->slug;
            $head_data['props']['shorttitle'] = $data['disc']['details']->artist . ' - ' . $data['disc']['details']->album;
        }

        $menu_data['display'] = $head_data['props']['shorttitle'];
        $head_data['props']['title'] = 'A Head Full of Wishes: Discography: ' . $head_data['props']['shorttitle'];
        $this->load->view('wrapper/header', $head_data);
        $this->load->view('wrapper/menu', $menu_data);
        $this->load->view($selected_view, $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }

}

