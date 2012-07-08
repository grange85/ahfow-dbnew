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

}