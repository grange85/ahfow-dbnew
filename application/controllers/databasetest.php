<?php


class Databasetest extends CI_Controller {
    
    function __construct() {
        parent::__construct();
    }
    
    
    public function index(){
        
        $this->load->model('Galaxiedb');
        $data['artists']=$this->Galaxiedb->get_artists();
        $this->load->view('artists', $data);
        
        
    }
    
    
}

?>
