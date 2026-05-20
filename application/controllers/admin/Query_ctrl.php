<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Query_ctrl extends CI_Controller
{
    function __construct(){
        parent :: __construct();
        $this->load->helper(array('url','file'));
        $this->load->library(array('session','form_validation','ion_auth','upload','lang_file','excel','pagination'));
        $this->load->database();
        $this->lang->load('admin_lang', 'english');
        if (!$this->ion_auth->logged_in()){
            redirect('admin/admin');
        }
    }
    
    function index() {
        $data['title'] = 'Query Runer';
        $data['head'] = $this->load->view('admin/comman/head','',TRUE);
        $data['header'] = $this->load->view('admin/comman/header','',TRUE);
        $data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
        $data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
        $data['main_contant'] = $this->load->view('admin/pages/logg/query_view',$data,TRUE);
        $this->load->view('admin/comman/index',$data);
    }
    
    function run_query(){
        $query_check = $this->input->post('query_check');
        $box_query = $this->input->post('box_query');
        
        if($query_check == 'other'){
            $data = $this->db->query($box_query);
            if($data){
                echo json_encode(array('msg'=>'Query run successfully','status'=>200));
            }else{
                echo json_encode(array('msg'=>'Query Error.','status'=>500));
            }
        }elseif($query_check == 'select_query'){
            $data = $this->db->query($box_query);
            $result = $data->result_array();
            if(count($result) > 0){
                echo json_encode(array('result'=>$result,'status'=>200));
            }else{
                echo json_encode(array('msg'=>'Wrong Query','status'=>500));
            }
        }
   
    }
    
}