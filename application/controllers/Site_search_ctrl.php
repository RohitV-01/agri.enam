<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_search_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->database();
		$this->load->model(array('admin/Language_model','admin/Users_model','admin/Video_model','admin/Slider_model','admin/Widget_model','admin/Menu_model','Enam_model','admin/Event_model'));
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
		    $this->session->set_userdata($newdata);
		}	$this->lang->load('client_lang', 'hindi');
	}
	
	function index(){
		$l_id = (int)($this->session->userdata('client_language') ?: 1);
		$text = $this->input->post('site_search');
		if($text != ''){
			$this->db->select('pi.page_id,pi.page_body,pi.title,p.is_static,p.url,m.cms_url');
			$this->db->join('pages p','p.p_id = pi.page_id');
			$this->db->join('menu m','m.page_id = p.p_id');
			$this->db->like('page_body',$text,'both');
			$data['suggestions'] = $this->db->get_where('page_item pi',array('pi.lang_id'=>$l_id,'pi.status'=>1,'m.status'=>1))->result_array();
		}
		$data['text'] = $text;
		$data['title'] = 'eNam |key'.$text;
		$data['keywords'] = 'enam home';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['languages'] = $this->Language_model->get_all_language();
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['marqueeSection'] = $this->load->view('pages/comman/marqueeSection','',TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
		$data['sliders'] = $this->Slider_model->slider_list_client();
		$data['main_contant'] = $this->load->view('pages/site_search/site_search',$data,TRUE);
		$this->load->view('comman/index',$data);
	}
}
