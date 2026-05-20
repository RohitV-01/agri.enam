<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->library(array('session','ion_auth'));
		$this->load->database();
		$this->load->model(array('admin/Language_model','admin/Users_model','admin/Widget_model','admin/Page_model','admin/News_model','admin/Slider_model','admin/Video_model','admin/Links_model'));
		$this->lang->load('admin_lang', 'english');
		if (!$this->ion_auth->logged_in()){
			redirect('admin/admin');
		}
	}
	
	function all_pages(){
		$data['title'] = ' pages';
		$data['pages'] = $this->Page_model->get_all_pages();
		$data['head'] = $this->load->view('admin/comman/head',$data,TRUE);
		$data['header'] = $this->load->view('admin/comman/header','',TRUE);
		$data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
		$data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('admin/pages/layout/all_pages',$data,TRUE);
		$this->load->view('admin/comman/index',$data);
	}
	
	function index($p_id = null){
		$l_id = (int)$this->session->userdata('language');
		if($p_id != null){
			$data['page_id'] = $p_id;
			$data['title'] = 'Update Page';
			$data['widgets'] = $this->Widget_model->all_widgets();
			
			$this->db->select('p.*,pi.title as page_title, pi.meta_tag, pi.keywords, pi.page_body');
			$this->db->join('page_item pi','pi.page_id=p.p_id');
			$page_detail = $this->db->get_where('pages p',array('p_id'=>(int)$p_id,'pi.lang_id'=>$l_id,'p.status'=>1,'pi.status'=>1))->result_array();

			if(!count($page_detail)>0){
			    $this->db->select('p.*,pi.title as page_title, pi.meta_tag, pi.keywords, pi.page_body');
			    $this->db->join('page_item pi','pi.page_id=p.p_id');
			    $page_detail = $this->db->get_where('pages p',array('p_id'=>(int)$p_id,'pi.lang_id'=>1,'p.status'=>1,'pi.status'=>1))->result_array();
			}
			
			if($page_detail[0]['type'] == 'que_ans'){
			    $this->db->select('*');
			    $this->db->join('question_ans_item qai','qai.qa_id = qa.q_id');
			    $questions = $this->db->get_where('question_ans qa',array('qa.page_id'=>(int)$p_id,'qai.lang_id'=>$l_id,'qa.status'=>1))->result_array();
				if(empty($questions)){
					$this->db->select('*');
					$this->db->join('question_ans_item qai','qai.qa_id = qa.q_id');
					$questions = $this->db->get_where('question_ans qa',array('qa.page_id'=>(int)$p_id,'qai.lang_id'=>1,'qa.status'=>1))->result_array();
				}
			    $data['page_details'] = $page_detail;
			    $data['page_details']['questions'] = $questions;
			}
			else{
    			$this->db->select('p.*,pi.meta_tag,pi.keywords,pi.page_body,pi.title as page_title');
    			$this->db->join('page_item pi','pi.page_id = p.p_id');
    			$result = $this->db->get_Where('pages p',array('p.p_id'=>(int)$data['page_id'],'p.status'=>1,'pi.status'=>1,'pi.lang_id'=>(int)$this->session->userdata('language')))->result_array();
    			if(count($result) > 0){
    				$data['page_details'] = $result;
    			}
    			else{
    				$this->db->select('p.*,pi.meta_tag,pi.keywords,pi.page_body,pi.title as page_name');
    				$this->db->join('page_item pi','pi.page_id = p.p_id');
    				$result = $this->db->get_Where('pages p',array('p.p_id'=>(int)$data['page_id'],'p.status'=>1,'pi.status'=>1,'pi.lang_id'=>1))->result_array();
    								
    				$data['page_details'] = $result;
    			}
			}
  		// print_r($data); die;
			$data['head'] = $this->load->view('admin/comman/head',$data,TRUE);
			$data['header'] = $this->load->view('admin/comman/header','',TRUE);
			$data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
			$data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
			$data['main_contant'] = $this->load->view('admin/pages/layout/add_page',$data,TRUE);
			$this->load->view('admin/comman/index',$data);
		}
		else{
			$data['title'] = 'create New Page';
			$data['widgets'] = $this->Widget_model->all_widgets();
			$data['head'] = $this->load->view('admin/comman/head',$data,TRUE);
			$data['header'] = $this->load->view('admin/comman/header','',TRUE);
			$data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
			$data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
			$data['main_contant'] = $this->load->view('admin/pages/layout/add_page',$data,TRUE);
			$this->load->view('admin/comman/index',$data);
		}
	}
	
	function page_create(){
			$data['page_id'] = (int)$this->input->post('page_id');
			$data['checkbox_control'] = $this->input->post('checkbox_control');
			$data['checkbox_url'] = $this->input->post('checkbox_url');
			if($data['checkbox_control']){
				$data['checkbox_control'] = 1;
			}
			else{
				$data['checkbox_control'] = 0;
				$data['checkbox_url'] = 'NULL';
			}
			
			if($data['page_id'] == ''){
				// new page create
				$this->db->trans_begin();
				$data['page_name'] = $this->input->post('page_name');
				$data['title'] = $this->input->post('page_title');
				$data['type'] = $this->input->post('page_type');
				$data['page_layout'] = $this->input->post('page_layout');
				$data['meta_tag'] = $this->input->post('meta_tag');
				$data['keyword'] = $this->input->post('keyword');
				$data['page_body'] = $this->input->post('page_body',false);
				if($data['page_layout'] == 1){
					$data['component'] = $this->input->post('one_col_maincontent');
				}
				else if($data['page_layout'] == 2){
					$data['left_component'] = $this->input->post('two_col_leftcontent');
					$data['component'] = $this->input->post('two_col_maincontent');
				}
				else {
					$data['left_component'] = $this->input->post('three_col_leftcontent');
					$data['component'] = $this->input->post('three_col_maincontent');
					$data['right_component'] = $this->input->post('three_col_rightcontent');
				}
				
				$this->db->insert('pages',array(
						'page_name' => $data['page_name'],
						'page_layout' => $data['page_layout'],
						'is_static' => $data['checkbox_control'],
						'type' => $data['type'],
						'url'	=> $data['checkbox_url'],
						'created_at' => date('y-m-d h:i:s'),
						'created_by' => $this->session->userdata('user_id')
				));
				
				$page_id = $this->db->insert_id();
					//--------------update log table---------------------
				$this->load->library('lang_file');
				$log_data['event_id'] = 11;
				$log_data['activity_id'] = $page_id;
				$this->lang_file->logg_report($log_data);
				//----------------------------------------------------
				
				$bulk_data = array();
				if(isset($data['left_component'])){
					foreach($data['left_component'] as  $left){
						$temp = array();
						$temp['page_id'] = $page_id;
						$temp['section'] = 'left_col';
						$temp['widget_id'] = $left;
						$bulk_data[] = $temp;
					}
				}
				
				if(isset($data['component'])){
					foreach($data['component'] as $component){
						$temp = array();
						$temp['page_id'] = $page_id;
						$temp['section'] = 'main_body';
						$temp['widget_id'] = $component;
						$bulk_data[] = $temp;
					}
				}
					
				if(isset($data['right_component'])){
					foreach($data['right_component'] as $right_component){
						$temp = array();
						$temp['page_id'] = $page_id;
						$temp['section'] = 'right_col';
						$temp['widget_id'] = $right_component;
						$bulk_data[] = $temp;
					}
				}
				if(isset($bulk_data) && count($bulk_data)>0 ){
					$this->db->insert_batch('page_components',$bulk_data);
				}
				
				$question_ans = array();
				$questions = array();
				$ans = array();
				$sort = array();
				if($data['type'] == 'que_ans'){
					for($i=1; $i < 9; $i++){
						if($this->input->post('questions_'.$i) != ''){
							$temp = array();
							$temp['page_id'] = $page_id;
							$temp['question'] = $this->input->post('questions_'.$i);
							$temp['ans'] = $this->input->post('ans_'.$i);
							$temp['q_sort'] = $this->input->post('sort_'.$i);
							$temp['created_at'] = date('y-m-d h:i:s');
							$temp['created_by'] = $this->session->userdata('user_id');
							$temp['ip'] = $this->input->ip_address();							
							
							if($this->db->insert('question_ans',$temp)){
								unset($temp['page_id']);
								unset($temp['q_sort']);
								$temp['qa_id'] = $this->db->insert_id();
								$temp['lang_id'] = 1;
								
								$this->db->insert('question_ans_item',$temp);
							}
						}
						else{
							continue;
						}
					}	
				}
				
				$this->db->insert('page_item',array(
						'lang_id' => $this->session->userdata('language'),
						'page_id' => $page_id,
						'title'  => $data['page_name'],
						'meta_tag' => $data['meta_tag'],
						'keywords' => $data['keyword'],
						'page_body' => $data['page_body'],
						'created_at' => date('y-m-d h:i:s'),
						'created_by' => $this->session->userdata('user_id'),
						'ip'	=> $this->input->ip_address()
				));
				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					echo json_encode(array('msg'=>'Page not created successfully.','status'=>500));
				}
				else {
					$this->db->trans_commit();
					echo json_encode(array('msg'=>'Page created successfully.','status'=>200));
				}
				
			}
			else {
				// page update
				$this->db->trans_begin();
				$data['page_id'] = (int)$this->input->post('page_id');
				$data['page_name'] = $this->input->post('page_name');
				$data['title'] = $this->input->post('page_title');
				$data['type'] = $this->input->post('page_type');
				$data['page_layout'] = $this->input->post('page_layout');
				$data['meta_tag'] = $this->input->post('meta_tag');
				$data['keyword'] = $this->input->post('keyword');
				$data['page_body'] = $this->input->post('page_body',false);
				$data['checkbox_control'] = $data['checkbox_control'];
				$data['checkbox_url'] = $data['checkbox_url'];
				
				if($data['page_layout'] == 1){
					$data['component'] = $this->input->post('one_col_maincontent');
				}
				else if($data['page_layout'] == 2){
					$data['left_component'] = $this->input->post('two_col_leftcontent');
				}
				else if($data['page_layout'] == 3){
					$data['right_component'] = $this->input->post('two_col_right_rightcontent');
				}
				else {
					$data['left_component'] = $this->input->post('three_col_leftcontent');
					$data['component'] = $this->input->post('three_col_maincontent');
					$data['right_component'] = $this->input->post('three_col_rightcontent');
				}
				
        		$result = $this->db->get_where('page_item',array('page_id'=>$data['page_id'],'lang_id'=>$this->session->userdata('language'),'status'=>1))->result_array();
        		
				if(count($result)>0){
					$this->db->where('id',$result[0]['id']);
					$this->db->update('page_item',array(
						'lang_id' => $this->session->userdata('language'),
						'page_id' => $data['page_id'],
						'title' => $data['title'],
						'meta_tag' => $data['meta_tag'],
						'keywords' => $data['keyword'],
						'page_body' => $data['page_body']
					));
				}
				else{
					$this->db->insert('page_item',array(
						'lang_id' => $this->session->userdata('language'),
						'page_id' => $data['page_id'],
						'title' => $data['title'],
						'meta_tag' => $data['meta_tag'],
						'keywords' => $data['keyword'],
						'page_body' => $data['page_body'],
						'created_at' => date('y-m-d h:i:s'),
						'created_by' => $this->session->userdata('user_id')
					));
				}
				
        		$this->db->where('p_id',$data['page_id']);
				if($this->ion_auth->is_admin()){
					$this->db->update('pages',array(
						'page_layout' => $data['page_layout'],
						'is_static' => $data['checkbox_control'],
						'type' => $data['type'],
						'url'	=> $data['checkbox_url'],
						'updated_at' => date('y-m-d h:i:s'),
						'updated_by' => $this->session->userdata('user_id')
					));
				}
				else{
					$this->db->update('pages',array(
						'updated_at' => date('y-m-d h:i:s'),
						'updated_by' => $this->session->userdata('user_id')
					));
				}
						
				//--------------update log table---------------------
				$this->load->library('lang_file');
				$log_data['event_id'] = 12;
				$log_data['activity_id'] = $data['page_id'];
				$this->lang_file->logg_report($log_data);
				//----------------------------------------------------
						
				if($this->ion_auth->is_admin()){		
					$this->db->where('page_id',$data['page_id']);
					$this->db->update('page_components',array('status'=>0));
						
					$bulk_data = array();
					if(isset($data['left_component'])){
						foreach($data['left_component'] as  $left){
							$temp = array();
							$temp['page_id'] = $data['page_id'];
							$temp['section'] = 'left_col';
							$temp['widget_id'] = $left;
							$bulk_data[] = $temp;
						}
					}
					
					if(isset($data['component'])){
						foreach($data['component'] as $component){
							$temp = array();
							$temp['page_id'] = $data['page_id'];
							$temp['section'] = 'main_body';
							$temp['widget_id'] = $component;
							$bulk_data[] = $temp;
						}
					}
						
					if(isset($data['right_component'])){
						foreach($data['right_component'] as $right_component){
							$temp = array();
							$temp['page_id'] = $data['page_id'];
							$temp['section'] = 'right_col';
							$temp['widget_id'] = $right_component;
							$bulk_data[] = $temp;
						}
					}
	
					if(isset($bulk_data) && count($bulk_data)>0){
						$this->db->insert_batch('page_components',$bulk_data);
					}
				}
        				
				if($data['type'] == 'plain'){
					$this->db->where(array('page_id'=>$data['page_id'],'lang_id'=>$this->session->userdata('language')));
					$this->db->update('page_item',array(
							'title'  => $data['title'],
							'meta_tag' => $data['meta_tag'],
							'keywords' => $data['keyword'],
							'updated_at' => date('y-m-d h:i:s'),
							'updated_by' => $this->session->userdata('user_id'),
							'ip'	=> $this->input->ip_address()
					));
				}
				else{
					$ques_ids = $this->input->post('que');
					$l_id = $this->session->userdata('language');
					
					$question_ans = array();
					$questions = array();
					$ans = array();
					$sort = array();
					if($data['type'] == 'que_ans'){
						for($i=1; $i < 9; $i++){
							if(($this->input->post('questions_'.$i)) != ''){
								$temp = array();
								$temp['page_id'] = $data['page_id'];
								$temp['qa_id'] = $ques_ids[$i-1];
								$temp['question'] = $this->input->post('questions_'.$i);
								$temp['ans'] = $this->input->post('ans_'.$i);
								$temp['q_sort'] = $this->input->post('sort_'.$i);
								$temp['updated_at'] = date('y-m-d h:i:s');
								$temp['updated_by'] = $this->session->userdata('user_id');
								$temp['ip'] = $this->input->ip_address();							
								$question_ans[] = $temp;
                                                                $this->db->where('q_id',$temp['qa_id']);
								$this->db->update('question_ans',array('q_sort'=>$temp['q_sort']));
							}
							else{
								continue;
							}
						}	
					}
					foreach($question_ans as $qa){
					    $this->db->select('q_id');
					    $result = $this->db->get_where('question_ans_item',array(
					        'qa_id'=>(int)$qa['qa_id'],
					        'lang_id'=>$l_id,
					        'status'=>1
					    ))->result_array(); 
						if(count($result)>0){
							$this->db->where('q_id',$result[0]['q_id']);
							$this->db->update('question_ans_item',array(
								'question' => $qa['question'],
								'ans' => $qa['ans'],
								'updated_at' => date('y-m-d h:i:s'),
								'updated_by' => $this->session->userdata('user_id'),
								'ip' =>$this->input->ip_address()
							));
						}
						
						else{
						    if($this->ion_auth->is_admin()){
    							$this->db->insert('question_ans',array(
    								'page_id' => $data['page_id'],
    								'question' => $qa['question'],
    								'ans' => $qa['ans'],
    								'q_sort' => $qa['q_sort'],
    								'created_at' => date('y-m-d h:i:s'),
    								'created_by' => $this->session->userdata('user_id'),
    								'ip' =>$this->input->ip_address()
    							));
    							$x = $this->db->insert_id();
						    }
							
							
							$this->db->insert('question_ans_item',array(
								'question' => $qa['question'],
								'ans' => $qa['ans'],
								'lang_id' => $l_id,
							        'qa_id' => (int)$qa['qa_id'],
								'created_at' => date('y-m-d h:i:s'),
								'created_by' => $this->session->userdata('user_id'),
								'ip' =>$this->input->ip_address()
							));
						}
					}
				}
				
				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					echo json_encode(array('msg'=>'Page not updated successfully.','status'=>500)); 
				}
				else{
					$this->db->trans_commit();
					echo json_encode(array('msg'=>'Page updated Successfully.','status'=>200));
				}
			}
		}
		
		
		function url_check(){
				$checkbox_url = $this->input->post('checkbox_url');
				
				$result = $this->db->get_where('menu',array('cms_url'=>$checkbox_url,'status'=>1))->result_array();
				if(count($result) > 0){
					echo json_encode(array('msg'=>'This url already exist.','status'=>500));
				}
				elseif(!count($result) > 0){
					$result1 = $this->db->get_where('pages',array('url'=>$checkbox_url,'status'=>1))->result_array();
					if(count($result1) > 0){
					echo json_encode(array('msg'=>'This url already exist.','status'=>500));
					}
					else{
						echo json_encode(array('msg'=>'Congretes.','status'=>200));
					}
				}
		}

function page_delete(){
			$p_id = $this->input->post('page_id');
			if($this->ion_auth->is_admin()){
				 //--------------update log table---------------------
			    $this->load->library('lang_file');
			    $log_data['event_id'] = 13;
			    $log_data['activity_id'] = $p_id;
			    $this->lang_file->logg_report($log_data);
			    //----------------------------------------------------
			    
				
				$this->db->where('p_id',$p_id);
				$this->db->update('pages',array('status'=>0));
				echo json_encode(array('msg'=>'page deleted sucessfully.','status'=>200)); 
			}
			else{
				echo json_encode(array('msg'=>'Your dont have permission','status'=>203));
			}
		}
		
		
	function que_delete(){
		    $que = $this->input->post('que');
		    $this->db->where(array('q_id'=>$que));
		    $this->db->update('question_ans',array(
		        'status'=>0
		    ));
		    
		    $this->db->where(array('qa_id'=>$que));
		    $result = $this->db->update('question_ans_item',array(
		        'status'=>0
		    ));
		    
		    if($result){
		        echo json_encode(array('msg'=>'Question Deleted Successfully.','status'=>200));
		    }
		    else{
		        echo json_encode(array('msg'=>'Something Went Wrong.','status'=>500));
		    }
		}
		
	}
