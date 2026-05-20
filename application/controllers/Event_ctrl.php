<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->database();
		$this->load->model(array('admin/Language_model','Enam_model','Event_model'));
		$this->load->library(array('session','substring','lang_file'));
		if(!$this->session->userdata('client_language')){
		    $newdata = array(
		        'client_language'  => '1'
		    );
		}
		else{
		    $newdata = array(
		        'client_language'  => $this->session->userdata('client_language'),
		    );
		}
		    $this->session->set_userdata($newdata);
	}

	public function index($cat='national'){ 
        $data['page_id'] = 'page_9';
		$data['title'] = 'eNam | '.ucwords($cat).' Events Gallery';
		$data['keywords'] = 'enam events';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
        $data['languages'] = $this->Language_model->get_all_language();
		$data['events_categories'] = $this->Event_model->event_cat_list();	
		$data['events'] = $this->Event_model->event_list($cat);
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('pages/event_gallary/gallaries',$data,TRUE);
		$this->load->view('comman/index',$data);
	}
	
	function event_search_list(){
		$data['cat'] = $this->input->post('cat');
		$data['text'] = $this->input->post('text');
		$data['event_list'] = $this->Event_model->event_search_list($data);
		if(count($data['event_list'])>0){
			echo json_encode(array('data'=>$data['event_list'],'msg'=>'event list','status'=>200));
		}
		else{
			echo json_encode(array('msg'=>'no record found.','status'=>500));
		}
	}
	
	function event_gallery_data(){ 
		$data['event_id'] = $this->input->post('event_id');
		$data['sequence_id'] = $this->input->post('sequence_id');
		$data['event_category'] = $this->input->post('event_category');
	    $result = $this->Event_model->event_gallery_content($data);
		
		if($result){ 
			echo json_encode(array('data'=>$result,'msg'=>'Event Gallery Data.','status'=>200));
		}
		else{
			echo json_encode(array('msg'=>'Something gone wrong.','status'=>500));
		}
	}
}
