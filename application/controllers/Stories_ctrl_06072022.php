<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stories_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->database();
		$this->load->model(array('admin/Language_model','admin/Widget_model','admin/Menu_model','Enam_model'));
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
                   $data['page_id'] = 'page_3';
		$l_id = $this->session->userdata('client_language');

		$this->db->select('*');
		$this->db->join('success_story_item ssi','ssi.	success_id = ss.s_id');
		$data['stories'] = $this->db->get_where('success_story ss',array('ss.status'=>1,'ssi.lang_id'=>$l_id,'ss.publish'=>1))->result_array();
		
		$data['title'] = $data['title'] = $this->lang_file->heading_fetch('enam').' | '.$this->lang_file->heading_fetch('heading_stories');
		$data['keywords'] = 'Success Stories';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['languages'] = $this->Language_model->get_all_language();
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['links'] = $this->Enam_model->all_links();
		$data['quickLinks'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
		
		$data['search_page'] = $this->load->view('comman/home_search',$data,TRUE);
		$data['subscribe_page'] = $this->load->view('comman/home_subscribe',$data,TRUE);
		
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
		$data['home_body'] = $this->Widget_model->home_content();
		$data['slider'] = $this->load->view('pages/comman/slider',$data,TRUE);
		$data['links'] = $this->Enam_model->all_links();
		$data['main_contant'] = $this->load->view('pages/stories/stories',$data,TRUE);
		$this->load->view('comman/index',$data);
	}
}
