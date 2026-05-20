<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->library(array('session','form_validation','ion_auth','upload','substring'));
		$this->load->database();
		$this->load->model(array('admin/Language_model','admin/News_model','admin/Event_model','admin/Story_model', 'admin/Blog_model'));
		$this->lang->load('admin_lang', 'english');
		if (!$this->ion_auth->logged_in()){
			redirect('admin/admin');
		}
	}
	
	public function index(){ 
		$data['title'] = 'eNam Admin | Blog';
		$languages = $this->Language_model->get_all_language();
		$data['Blogs_client'] = $this->Blog_model->blog_list();
		$data['head'] = $this->load->view('admin/comman/head','',TRUE);
		$data['header'] = $this->load->view('admin/comman/header','',TRUE);
		$data['navigation'] = $this->load->view('admin/comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('admin/pages/blogs/blogs',$data,TRUE);
		$this->load->view('admin/comman/index',$data);
	}
	
	function blog_create(){  

		//print_r($_FILES);exit;

		$this->form_validation->set_rules('blog_id', 'Blog id', 'trim|integer|is_natural_no_zero');
		$this->form_validation->set_rules('blog_title', 'Blog Title', 'required|trim|min_length[3]');
		$this->form_validation->set_rules('blog_desc', 'Blog Desc', 'required|trim|min_length[3]');
		if($this->ion_auth->is_admin()){
			$this->form_validation->set_rules('blog_order', 'Blog Order', 'required|trim|integer');
		}
	
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message',validation_errors());
			echo validation_errors();
		}
		else{

			date_default_timezone_set("Asia/Kolkata");
			$data['bid'] = $this->input->post('blog_id');
			$data['blog_title'] = $this->input->post('blog_title');
			$data['blog_desc'] = $this->input->post('blog_desc');
			$data['blog_order'] = $this->input->post('blog_order');
			$data['blog_apmcstate'] = $this->input->post('blog_apmcstate');
			$data['blog_publisher'] = $this->input->post('blog_publisher');
			if($this->ion_auth->is_admin()){
				$data['blog_order'] = $this->input->post('blog_order');
			}
			$data['created_at'] = date('Y-m-d h:i:s');
			$data['created_by'] = $this->session->userdata('user_id');
			$data['created_at'] = date('Y-m-d h:i:s');
			$data['created_by'] = $this->session->userdata('user_id');
			
			if($data['bid'] == ''){
				// story create
				if(!empty($_FILES['userFiles']['name'])){
					$file_name = $_FILES['userFiles']['name'];
					 
					$story_file = date('U');
					$x = explode('.',$file_name);
					$_FILES['userFile']['name'] = $story_file.'.'.end($x);
					$_FILES['userFile']['type'] = $_FILES['userFiles']['type'];
					$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'];
					$_FILES['userFile']['error'] = $_FILES['userFiles']['error'];
					$_FILES['userFile']['size'] = $_FILES['userFiles']['size'];
						
	
					if(is_dir('./assest/images/blogs/')){
						$uploadPath = './assest/images/blogs/';
					}
					else{
						mkdir('./assest/images/blogs/');
						$uploadPath = './assest/images/blogs/';
					}
					$config['overwrite'] = true;
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'jpg|png|jpeg|JPEG|PNG|JPEG';
	
					$this->load->library('image_lib');
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
	
					if($this->upload->do_upload('userFile')){
						$upload_data = $this->upload->data();
						$data['blog_image'] = $upload_data['file_name'];
						$result = $this->Blog_model->blog_create($data);
						if($result){
							echo json_encode(array('msg'=>'blog created successfully.','status'=>200));
						}
						else{
							delete_files($uploadPath.$data['blog_image']);
							echo json_encode(array('msg'=>'Something gone wrong.','status'=>500));
						}
					}
					else{
						$error = array('error' => $this->upload->display_errors());
						print_r($error); die;
					}
				}
			}
			else {
				// blog update

				if(!empty($_FILES['userFiles']['name'])){
					$file_name = $_FILES['userFiles']['name'];
					
					$file_name = $_FILES['userFiles']['name'];
					
					$story_file = date('U');
					$x = explode('.',$file_name);
					$_FILES['userFile']['name'] = $story_file.'.'.end($x);
					$_FILES['userFile']['type'] = $_FILES['userFiles']['type'];
					$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'];
					$_FILES['userFile']['error'] = $_FILES['userFiles']['error'];
					$_FILES['userFile']['size'] = $_FILES['userFiles']['size'];
					
					if(is_dir('./assest/images/blogs/')){
						$uploadPath = './assest/images/blogs/';
					}
					else{
						mkdir('./assest/images/blogs/');
						$uploadPath = './assest/images/blogs/';
					}
						
					$config['overwrite'] = true;
					$config['upload_path'] = $uploadPath;
					$config['allowed_types'] = 'jpg|png|jpeg|JPEG|PNG|JPEG';
	
					$this->load->library('image_lib');
					$this->load->library('upload', $config);
					$this->upload->initialize($config);
	
					if($this->upload->do_upload('userFile')){
						$upload_data = $this->upload->data();		
						$data['blog_image'] = $upload_data['file_name'];
						$result = $this->Blog_model->blog_update($data);
						if($result){
							echo json_encode(array('msg'=>'Blog update successfully.','status'=>200));
						}
						else{
							delete_files($uploadPath.$data['blog_image']);
							echo json_encode(array('msg'=>'Something gone wrong.','status'=>500));
						}
					}
					else{
						$error = array('error' => $this->upload->display_errors());
						print_r($error); die;
					}
				}
				else{
					$result = $this->Blog_model->blog_update($data);
					if($result){
						echo json_encode(array('msg'=>'blog updated successfully.','status'=>200));
					}
					else{
						echo json_encode(array('msg'=>'Something gone wrong.','status'=>500));
					}
				}
			}
		}
	}
	
	function get_blog_content(){
		$data['blog_id'] = (int) $this->input->post('blog_id');
		$data['lang_id'] = (int) $this->session->userdata('language');
		$data['ip'] = $this->input->ip_address();
		$data['updated_at'] = date('d-m-y h:i:s');
		$data['updated_by'] = (int) $this->session->userdata('user_id');
	
		$result = $this->Blog_model->get_story_content($data);
		
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'msg'=>'Blog content.','status'=>200));
		}
		else{
			echo json_encode(array('msg'=>'no record found.','status'=>500));
		}
	}
	
	function Blog_publish(){
		if($this->ion_auth->is_admin()){
			$this->form_validation->set_rules('blog_id', 'blog id', 'required|trim|integer|is_natural_no_zero');
			$this->form_validation->set_rules('status', 'Blog Status', 'required|trim');
				
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('message',validation_errors());
				echo validation_errors();
			}
			else{
				$data['blog_id'] = (int)$this->input->post('blog_id');
				$data['status'] = $this->input->post('status');
				if($data['status'] == 'true'){
					$data['status'] = 1;
				}
				else{
					$data['status'] = 0;
				}
	
				$result = $this->Blog_model->blog_publish($data);
				if($result){
					echo json_encode(array('msg'=>'Operation successfull.','status'=>200));
				}
				else{
					echo json_encode(array('msg'=>'Something wrong.','status'=>500));
				}
			}
		}
		else{
			echo json_encode(array('msg'=>'You are not authorized.','status'=>500));
		}
	}
	
	function blog_delete(){
		if($this->ion_auth->is_admin()){
			$this->form_validation->set_rules('blog_id', 'Blog Id', 'required|trim|integer|is_natural_no_zero');
				
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('message',validation_errors());
				echo validation_errors();
			}
			else{
				$data['blog_id'] = (int)$this->input->post('blog_id');
				$result = $this->Blog_model->blog_delete($data);
				if($result){
					echo json_encode(array('msg'=>'Operation successfull.','status'=>200));
				}
				else{
					echo json_encode(array('msg'=>'Something wrong.','status'=>500));
				}
			}
		}
		else{
			echo json_encode(array('msg'=>'You are not authorized.','status'=>500));
		}
	}

}