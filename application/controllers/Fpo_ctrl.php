<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fpo_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->database();
		$this->load->library('email');
		$this->load->model(array('admin/Language_model','admin/Widget_model','admin/Menu_model','Enam_model'));
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

	public function fpo()
	{ 
 		$data['page_id'] = 'page_10';
		$data['title'] = 'eNAM | Fpo_ctrl';
		$data['keywords'] = 'enam Fpo_ctrl';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
	    $data['languages'] = $this->Language_model->get_all_language();
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('pages/fpo/fpo',$data,TRUE);
		$this->load->view('comman/index',$data);
	}

 
	
}
?>
