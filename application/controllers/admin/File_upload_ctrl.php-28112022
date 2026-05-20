<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_upload_ctrl extends CI_Controller
{
    function __construct(){
        parent :: __construct();
        $this->load->helper(array('url','file','directory'));
        $this->load->library(array('session','form_validation','ion_auth','upload','lang_file','excel','pagination'));
        $this->load->database();
        $this->lang->load('admin_lang', 'english');
        if (!$this->ion_auth->logged_in()){
            redirect('admin/admin');
        }
    }
    
    function index(){
        $data['title'] = 'File Upload';
        $data['head'] = $this->load->view('admin/comman/head','',TRUE);
        $data['header'] = $this->load->view('admin/comman/header','',TRUE);
        $data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
        $data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
        $data['main_contant'] = $this->load->view('admin/pages/logg/file_upload',$data,TRUE);
        $this->load->view('admin/comman/index',$data);
    }
    
    public function import(){
        $path = $this->input->post('path');
        
        if(!empty($_FILES['file']['name'])){
            
            $file_name = $_FILES['file']['name'];
            $temp=$_FILES['file']['tmp_name'];
            if(move_uploaded_file($temp,$path."/".$file_name)){
                echo json_encode(array('msg'=>'Insert Successfully','status'=>'200'));
            }
           
       }        
    }

       public function file_list(){
        $path = $this->input->post('path');        
        $files = directory_map($path);
        
        if(count($files) > 0){
            echo json_encode(array('files'=>$files,'status'=>200));
        }else{
            echo json_encode(array('msg'=>'File not Found.','status'=>500));
        }
    }
}