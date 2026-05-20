<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file','captcha'));
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

	public function contact_us()
	{ 
                $characters = '0123456789!@#$ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characters = str_shuffle($characters);
		$randstring = '';
		$randstring = substr($characters,0,4);
		$vals = array(
			'word'          => $randstring,
			'img_path'      => './captcha/',
			'img_url'       =>  base_url().'captcha/',
			'font_path'     => FCPATH . 'captcha/font/captcha4.ttf',
			'img_width'     => '290',
			'img_height'    => 65,
			'expiration'    => 7200,
			'word_length'   => 8,
			'font_size'     => 16,
			'img_id'        => 'Imageid',
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

			// White background and border, black text and red grid
			'colors'        => array(
					'background' => array(255, 255, 255),
					'border' => array(255, 255, 255),
					'text' => array(0, 0, 0),
					'grid' => array(255, 40, 40)
			)
	);

		$cap = create_captcha($vals);
		//echo $cap['image']; die;
		 $data['cap_image'] =  $cap['image'];
		 $data['cap_word'] =  $cap['word'];
		 //$data['cap_image'] =  $cap['image'];
                $data['page_id'] = 'page_10';
		$data['title'] = 'eNAM | Contact us';
		$data['keywords'] = 'enam contact us';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
	        $data['languages'] = $this->Language_model->get_all_language();
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('pages/contactus/contact-us',$data,TRUE);
		$this->load->view('comman/index',$data);
	}

	function contact_mail(){
		$data['email'] = $this->input->post('email');
		$data['co_us_desc'] = $this->input->post('contact_desc');
		$data['mail_opt'] = $this->input->post('mail_opt');
		$data['con_us_name'] = $this->input->post('con_us_name');
		$data['con_us_contact'] = $this->input->post('con_us_contact');
		$data['con_us_add'] =  $this->input->post('con_us_add');
		$data['con_us_stak'] = $this->input->post('con_us_stak');
 		$message = html_entity_decode($this->load->view('pages/email',$data,true));

// 		$config['mailtype'] = 'html';
// 		$config['charset']  = 'utf-8';
// 		$config['newline']  = "\r\n";
// 		$config['wordwrap'] = TRUE;

// 		$this->load->library('email',$config);
// 		$this->email->from($data['email'], $data['con_us_name']);
// 		$this->email->to('fakelying@gmail.com');
// 		$this->email->subject('Registration');
// 		$this->email->message($message);
// 		if (!$this->email->send())
// 		{
// 			echo $this->email->print_debugger();
// 		}
		
		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		$this->email->from($data['email'], $data['con_us_name']);
		$this->email->to('enam.helpdesk@gmail.com');
		$this->email->bcc('nam@sfac.in');
		//print_r($data);exit;
		$this->email->subject('Registration');
		$this->email->message($message);
		
		if($this->email->send())
			     {
			      echo json_encode(array('msg'=>'Email Sent Successfully','status'=>200));
			     }
			     else
			    {
			     show_error($this->email->print_debugger());
			    }
		
	}
	 

	function email(){
		$data['title'] = 'eNam';
		$data['keywords'] = 'enam home';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['languages'] = $this->Language_model->get_all_language();
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['marqueeSection'] = $this->load->view('pages/comman/marqueeSection','',TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
		$data['home_body'] = $this->Widget_model->home_content();
		$data['slider'] = $this->load->view('pages/comman/slider',$data,TRUE);
		$data['links'] = $this->Enam_model->all_links();
		$data['main_contant'] = $this->load->view('pages/email',$data,TRUE);
		$this->load->view('comman/index',$data);
	}


       function catpcha_refresh(){ 
		$characters = '0123456789!@#$ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$characters = str_shuffle($characters);
		$randstring = '';
		$randstring = substr($characters,0,4);
		$vals = array(
			'word'          => $randstring,
			'img_path'      => './captcha/',
			'img_url'       =>  base_url().'captcha/',
			'font_path'     => FCPATH . 'captcha/font/captcha4.ttf',
			'img_width'     => '290',
			'img_height'    => 65,
			'expiration'    => 7200,
			'word_length'   => 8,
			'font_size'     => 16,
			'img_id'        => 'Imageid',
			'pool'          => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',

			// White background and border, black text and red grid
			'colors'        => array(
					'background' => array(255, 255, 255),
					'border' => array(255, 255, 255),
					'text' => array(0, 0, 0),
					'grid' => array(255, 40, 40)
			)
	);

		$cap = create_captcha($vals);
		//echo $cap['image']; die;
		 $data['cap_image'] =  $cap['image'];
		 $data['cap_word'] =  $cap['word'];
		 echo json_encode(array('data'=>$data['cap_image'],'status'=>200));
		
	}

}
?>
