<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function Terms_And_Control()
	{
		//echo "test";
		$data['head'] = $this->load->view('comman/head',$data,TRUE);      
		$this->load->view('Terms_And_Control');
		$this->load->view('footer');
	}

}
