<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MY_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('logged_in')) {
            $this->username = $this->session->userdata('username');
        } else {
            $this->username = NULL;
        }

        if (!$this->session->userdata('logged_in') && !($this->router->method !== 'login' || $this->router->method !== 'register')) {
            $this->session->set_userdata('REDIRECT', uri_string());
            $this->output->set_status_header('401');
            redirect('admin/login');
        } else {
            
        }


        $this->load->model('ahfow_database');
        $this->load->model('users');
    }

    public function index() {
        $args = func_get_args();
        $data = array();
        
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/login');
        }

        $data['section'] = 'admin';
        $data['page_title'] = 'Home';
        $data['user'] = $this->username;

        $this->firephp->log($this->session->userdata);

        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/menu', $data);
        $this->load->view('admin', $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }

    public function login() {
        $args = func_get_args();
        $data = array();
        $data['page_title'] = 'Login';

        if ($this->session->userdata('logged_in')) {
            redirect('admin');
        }

        if ($this->input->post('Submit')) {

            if ($this->users->login($this->input->post('username'), $this->input->post('password'))) {
                redirect('admin');
            } else {
                $data['section'] = 'Try again';
            }
        } else {

            $data['section'] = 'admin';
        }



        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/menu', $data);
        $this->load->view('login', $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }

    public function register() {
        $args = func_get_args();
        $data = array();
        if ($this->session->userdata('logged_in')) {
            redirect('admin');
        }


        $data['section'] = 'admin';

//        if $this->session->userdata('Logged')

        if ($this->input->post('Submit')) {

            if ($this->users->check_username($this->input->post('username'))) {
                $this->users->register($this->input->post('username'), $this->input->post('email'), $this->input->post('password'));
                redirect('admin/login');
            } else {
                $data['section'] = 'Try again';
            }
        } else {
            $data['section'] = 'admin';
        }


        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/menu', $data);
        $this->load->view('register', $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }

    
    public function biography() {
        $args = func_get_args();
        $data = array();
        if (!$this->session->userdata('logged_in')) {
            redirect('admin/login');
        }        
        if ($this->input->post()){
            $this->firephp->log('here');
            $this->firephp->log($this->input->post());
            $this->ahfow_database->set_biography($this->input->post());
        }
        
        
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
        $this->firephp->log($this->input->post());
        $data['testcontent'] = $this->input->post('biography');
        $data['user'] = $this->username;
        $this->load->view('wrapper/header', $data);
        $this->load->view('wrapper/menu', $data);
        $this->load->view('edit/biography', $data);
        $this->load->view('wrapper/sidebar', $data);
        $this->load->view('wrapper/footer');
    }    
    
    
    
    
    
}