<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Theme_ctrl extends CI_Controller {

    function __construct(){
        parent :: __construct();
        $this->load->helper(array('url','file'));
        $this->load->library(array('session'));
    }
    
    
    public function theme_session(){
       $theme = $this->input->post('theme');
       
       if($theme == 'green-theme'){
           $theme = 'green-theme';
       }
       if($theme == 'red-box'){
           $theme = 'red-box';
       }
       if($theme == 'blue-box'){
           $theme = 'blue-box';
       }
       if($theme == 'orange-box'){
           $theme = 'orange-box';
       }
       
       $this->session->set_userdata('theme', $theme);
       $theme = $this->session->userdata('theme');
       if($theme){
           echo json_encode(array('theme'=>$theme,'status'=>200));
       }else{
           echo json_encode(array('status'=>500));
       }
   }
    
}