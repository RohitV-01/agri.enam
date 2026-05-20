<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elearning_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->database();
		$this->load->model(array('admin/Language_model','admin/Video_model','admin/Menu_model','Enam_model','Elearning_model'));
		$this->load->library(array('session','substring','lang_file'));
		if(!$this->session->userdata('client_language')){
			$newdata = array(
					'client_language'  => '1',
			);
		}
		else{
			$newdata = array(
					'client_language'  => $this->session->userdata('client_language'),
			);
		}
			$this->session->set_userdata($newdata);
	}

	public function index($cat='All'){ 
                $data['page_id'] = 'page_7';
		$data['title'] = $this->lang_file->heading_fetch('enam').' | '.$this->lang_file->heading_fetch('breadc_eler_vid');
		$data['keywords'] = 'enam home';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['languages'] = $this->Language_model->get_all_language();
		$data['video_categories'] = $this->Elearning_model->Video_cat_list();
		$data['videos'] = $this->Elearning_model->Video_list($cat);
		$v = array();
		foreach($data['videos'] as $ve){
			$temp = array();
			$temp = $ve;
			$temp['created_at'] = $this->substring->time_elapsed_string(strtotime($ve['created_at']));
			$v[] = $temp;
		}
		$data['videos'] = $v;	
		$data['page_id'] = 'page_-1';
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('pages/gallary/video_gallaries',$data,TRUE);
		$this->load->view('comman/index',$data);
	}
	
	function video_search_list(){
		$data['cat'] = $this->input->post('cat');
		$data['text'] = $this->input->post('text');
		$data['video_list'] = $this->Elearning_model->video_search_list($data);
		$v = array();
		foreach($data['video_list'] as $ve){
			$temp = array();
			$temp = $ve;
			$temp['created_at'] = $this->substring->time_elapsed_string(strtotime($ve['created_at']));
			$v[] = $temp;
		}
		$data['videos'] = $v;
		
		if(count($data['video_list'])>0){
			echo json_encode(array('data'=>$data['videos'],'msg'=>'video list','status'=>200));
		}
		else{
			echo json_encode(array('msg'=>'no record found.','status'=>500));
		}
	}
	
	function video_detail($id){ 
		$data['page_id'] = 78;
		$data['videos1'] = $this->Elearning_model->get_videos($id);
		$data['title'] = 'eNam|eLearning videos';
		$data['keywords'] = 'enam home';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
        $data['languages'] = $this->Language_model->get_all_language();
	    $data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['marqueeSection'] = $this->load->view('pages/comman/marqueeSection','',TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
		$data['videos'] = $this->Elearning_model->video_home_page_list($id);
		$v = array();
		foreach($data['videos'] as $ve){
			$temp = array();
			$temp = $ve;

			$temp['created_at'] = $this->substring->time_elapsed_string(strtotime($ve['created_at']));
			$v[] = $temp;
		}
		$data['videos'] = $v;
		$data['main_contant'] = $this->load->view('pages/gallary/video_show',$data,TRUE);
		$this->load->view('comman/index',$data);
	}

function video_views (){ 
 	 $this->db->set('views','views+1',false);
 	 $this->db->where('v_id',$this->input->post('v_id'));
 	 $this->db->update('video');
	}

}
