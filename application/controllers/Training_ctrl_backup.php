<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->database();
		$this->load->model(array('admin/Language_model','admin/Users_model','admin/Video_model','admin/Slider_model','admin/Widget_model','admin/Menu_model','Enam_model','admin/Event_model'));
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
			$this->session->set_userdata($newdata);
		}
	}

	
	public function index(){
        $data['page_id'] = 'page_8';
		$data['title'] = $this->lang_file->heading_fetch('enam').' | '.$this->lang_file->heading_fetch('head_page_trng_cal');
		$data['keywords'] = 'RESOURCES/Trainning Calendar';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['languages'] = $this->Language_model->get_all_language();
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['marqueeSection'] = $this->load->view('pages/comman/marqueeSection','',TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('pages/training-calender/training',$data,TRUE);
		$this->load->view('comman/index',$data);
	}
}