<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Databasetest extends MY_Controller {
    
  
    function __construct() {
        parent::__construct();
    }
    
    
    public function index(){
        
        $this->load->model('Galaxiedb');
        $data['artists']=$this->Galaxiedb->get_artists();
        $head_data['url']=  base_url();
//        $head_data['static']= STATIC_HOST;
        $head_data['props']['title']='A Head Full of Wishes';
        $this->load->view('wrapper/header', $head_data);
        $this->load->view('artists', $data);
        $this->load->view('wrapper/footer');
        
        
    }
    
    
}

?>
