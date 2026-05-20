<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Commodity_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file','form'));
		$this->load->library(array('session','ion_auth','form_validation','substring','lang_file'));
		$this->load->database();
		$this->load->model(array('admin/Language_model'));
		$this->lang->load('admin_lang', 'english');

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
		if (!$this->ion_auth->logged_in()){
			redirect('admin/admin');
		}
	}
	
	function index(){ 
		$l_id = $this->session->userdata('language');
		
		$this->db->select('c.c_id,ci.commodity_name');
		$this->db->join('commodity c','c.c_id = ci.com_id');
		$data['commodities'] = $this->db->get_where('commodities_item ci',array('ci.lang_id'=>1,'ci.status'=>1,'c.status'=>1))->result_array();

		$data['title'] = 'eNam Admin';
		$languages = $this->Language_model->get_all_language();
		foreach($languages as $language){
			if($language['l_id'] == $this->session->userdata('language'))
				$data['language'] = $language;
		}
		
		$data['head'] = $this->load->view('admin/comman/head','',TRUE);
		$data['header'] = $this->load->view('admin/comman/header','',TRUE);
		$data['navigation'] = $this->load->view('admin/comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('admin/pages/commodity/commodity',$data,TRUE);
		$this->load->view('admin/comman/index',$data);
	}
	
	function commodity_detail(){
		$l_id = $this->session->userdata('language');
		$c_id = $this->input->post('c_id');
		
		$this->db->select('cp.*,c.image as comm_image');
		$this->db->join('commodity c','c.c_id=cp.comm_id');
		$result = $this->db->get_where('commodity_parameters cp',array('cp.comm_id'=>$c_id,'cp.lang_id'=>$l_id,'cp.status'=>1,'c.status'=>1))->result_array();
		
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}
	
	function commodity_update(){
		$l_id = $this->session->userdata('language');
		$data1['comm_id'] = $this->input->post('commodity_id');
		$data['comm_title'] = $this->input->post('commodity_parameter_title',false);
		$data['comm_desc'] = $this->input->post('commodity_parameter_content',false);
		$data['comm_name'] = $this->input->post('commodity_name',false);
		
		if(!empty($_FILES['commodity_image_select']['name'])){
			$file_name = $_FILES['commodity_image_select']['name'];
			$comm_image = addslashes(preg_replace('/\s+/', '_', $data1['comm_id']));
			$x = explode('.',$file_name);
			$_FILES['commodity_image_select']['name'] = $comm_image.'.'.end($x);
			$_FILES['commodity_image_select']['type'] = $_FILES['commodity_image_select']['type'];
			$_FILES['commodity_image_select']['tmp_name'] = $_FILES['commodity_image_select']['tmp_name'];
			$_FILES['commodity_image_select']['error'] = $_FILES['commodity_image_select']['error'];
			$_FILES['commodity_image_select']['size'] = $_FILES['commodity_image_select']['size'];
			
			$uploadPath = 'assest/images/commodity-pro/';
			$config['overwrite'] = true;
			$config['upload_path'] = $uploadPath;
			$config['allowed_types'] = 'jpg|png|jpeg|JPEG|PNG|JPEG';
			
			$this->load->library('image_lib');
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload('commodity_image_select')){
				$upload_data = $this->upload->data();
				$data1['image'] = $upload_data['file_name'];
				
				$this->db->trans_begin();
				
				$this->db->where(array('c_id'=>$data1['comm_id'],'status'=>1));
				$this->db->update('commodity',array(
						'image' => $data1['image'] 
				));
				$this->db->select('*');
				$result = $this->db->get_where('commodity_parameters',array('comm_id'=>$data1['comm_id'],'lang_id'=>$l_id))->result_array();
				if(count($result)>0){
					$this->db->where(array('comm_id'=>$data1['comm_id'],'lang_id'=>$l_id));
					$this->db->update('commodity_parameters',$data);
					
					if ($this->db->trans_status() === FALSE){
						$this->db->trans_rollback();
						echo json_encode(array('msg'=>'commodity parameter update un-successfully.','status'=>200));
					}
					else{
						$this->db->trans_commit();
						echo json_encode(array('msg'=>'commodity parameter update successfully.','status'=>200));
					}
				}
				else{
					$this->db->insert('commodity_parameters',array(
							'comm_id' => $data1['comm_id'],
							'comm_title' => $data['comm_title'],
							'comm_desc' => $data['comm_desc'],
							'comm_name' => $data['comm_name'],
							'lang_id' => $l_id
					));
					
					if ($this->db->trans_status() === FALSE){
						$this->db->trans_rollback();
						echo json_encode(array('msg'=>'commodity parameter insert un-successfully.','status'=>500));
					}
					else{
						$this->db->trans_commit();
						echo json_encode(array('msg'=>'commodity parameter insert successfully.','status'=>200));
					}
				}
			}
			else{
				$error = array('error' => $this->upload->display_errors());
				print_r($error); die;
			}
		}
		else{
			$this->db->select('*');
			$result = $this->db->get_where('commodity_parameters',array('comm_id'=>$data1['comm_id'],'lang_id'=>$l_id))->result_array();
			
			if(count($result)>0){
				$this->db->where(array('comm_id'=>$data1['comm_id'],'lang_id'=>$l_id));
				$this->db->update('commodity_parameters',$data);
				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					echo json_encode(array('msg'=>'commodity parameter update un-successfully.','status'=>500));
				}
				else{
					$this->db->trans_commit();
					echo json_encode(array('msg'=>'commodity parameter update successfully.','status'=>200));
				}
			}
			else{
				$this->db->insert('commodity_parameters',array(
						'comm_id' => $data1['comm_id'],
						'comm_title' => $data['comm_title'],
						'comm_desc' => $data['comm_desc'],
						'comm_name' => $data['comm_name'],
						'lang_id' => $l_id
				));
				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					echo json_encode(array('msg'=>'commodity parameter insert un-successfully.','status'=>500));
				}
				else{
					$this->db->trans_commit();
					echo json_encode(array('msg'=>'commodity parameter insert successfully.','status'=>200));
				}
			}
		}
	}

function new_commo(){	
		$data['commodity_id'] = $this->input->post('add_commo_id');
		$data['commodity_name'] = $this->input->post('add_commo');
		$result = $this->db->insert('commodity',$data);
		if($result){
			echo json_encode(array('msg'=>'Commodity Added Successfully.','status'=>200));
		}
		else{
			echo json_encode(array('msg'=>'Something Went Wrong.','status'=>500));
		}
		
	}
	function commo_id_check(){
		$result = $this->db->get_where('commodity',array('commodity_id'=>$this->input->post('add_commo_id'),'status'=>1))->result_array();	
		if(count($result) > 0){ 
			echo json_encode(array('msg'=>'This Commodity Id Already Exist.','status'=>500));
		}
		else{
			echo json_encode(array('msg'=>'Congretes.','status'=>200));
		}
	}
	
	function category(){
		$this->db->select('*');
		$data['categories'] = $this->db->get_where('commodity_category',array('status'=>1))->result_array();
		$data['title'] = 'eNam Admin';
		$languages = $this->Language_model->get_all_language();
		foreach($languages as $language){
			if($language['l_id'] == $this->session->userdata('language'))
				$data['language'] = $language;
		}
		$data['head'] = $this->load->view('admin/comman/head','',TRUE);
		$data['header'] = $this->load->view('admin/comman/header','',TRUE);
		$data['navigation'] = $this->load->view('admin/comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('admin/pages/master/commodity_cat',$data,TRUE);
		$this->load->view('admin/comman/index',$data);
	}
	
	function category_create(){
		$data['c_id'] = $this->input->post('c_cat_id');
		$data['c_name'] = $this->input->post('c_category_name');
		if($data['c_id'] != ''){
			//update category
			$this->db->where('c_id',$data['c_id']);
			$this->db->update('commodity_category',array(
				'cg_name' => $data['c_name'],
				'updated_at' => date('Y-m-d h:i:s'),
				'updated_by' => (int)$this->session->userdata('user_id')
			));
			echo json_encode(array('msg'=>'commodity category updated successfully.','status'=>200));
		}
		else{
			//create category
			if($this->db->insert('commodity_category',array(
				'cg_name' => $data['c_name'],
				'created_by' =>	(int)$this->session->userdata('user_id'),
				'created_at' => date('Y-m-d h:i:s')
			))){
				echo json_encode(array('msg'=>'commodity category created successfully.','status'=>200));				
			}
			else{
				echo json_encode(array('msg'=>'commodity category not created.','status'=>500));
				}
			}
	}
	
	function commodity_list(){
		$this->db->select('*');
		$data['categories'] = $this->db->get_where('commodity_category',array('status'=>1))->result_array();
		$data['title'] = 'eNam Admin';
		$languages = $this->Language_model->get_all_language();
		foreach($languages as $language){
			if($language['l_id'] == $this->session->userdata('language'))
				$data['language'] = $language;
		}
		$data['head'] = $this->load->view('admin/comman/head','',TRUE);
		$data['header'] = $this->load->view('admin/comman/header','',TRUE);
		$data['navigation'] = $this->load->view('admin/comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('admin/pages/commodity/commodity_add',$data,TRUE);
		$this->load->view('admin/comman/index',$data);
	}
		
	function create_commodity(){
		$data['commodity_id'] = (int)$this->input->post('commodity_id');
		$data['commodity_name'] = $this->input->post('commodity_name');
		$data['group_id'] = (int)$this->input->post('commodity_group');
	
		if($data['commodity_id'] != ''){
			//update
			$data['g_id'] = $this->input->post('commodity_group');
			$data['c_id'] = $this->input->post('commodity_id');
			$data['commodity'] = $this->input->post('commodity_name');
			
			$this->db->trans_begin();
				$this->db->query("update commodity SET g_id = ".$data['g_id']." where c_id = (select com_id from commodities_item where c_id = ".$data['c_id']." and status = 1)");
				
				$this->db->where('c_id',$data['c_id']);
				$this->db->update('commodities_item',array('commodity_name'=>$data['commodity']));
				
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				echo json_encode(array('msg'=>'commodity not updated successfully.','status'=>500));
			}
			else{
				$this->db->trans_commit();
				echo json_encode(array('msg'=>'commodity updated successfully.','status'=>200));
			}
		}
		else{
			//create
			$l_id = $this->session->userdata('language');
			$this->db->trans_begin();
			
			$this->db->insert('commodity',array(
				'g_id' => $data['group_id'],
				'commodity_name' => $data['commodity_name'],
				'created_at' => date('Y-m-d h:i:s'),
				'created_by' => $this->session->userdata('user_id'),
				'ip' => $this->input->ip_address()
			));
			
			$this->db->insert('commodities_item',array(
				'com_id' => $this->db->insert_id(),
				'lang_id' => $l_id,
				'commodity_name' => $data['commodity_name'],
				'created_at' => date('Y-m-d h:i:s'),
				'created_by' => $this->session->userdata('user_id'),
				'status'=>1
			));
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				echo json_encode(array('msg'=>'commodity not created successfully.','status'=>500));
			}
			else{
				$this->db->trans_commit();
				echo json_encode(array('msg'=>'commodity created successfully.','status'=>200));
			}
		}
	}
	
	function commodity_category(){
	    $this->db->select('c_id,cg_name');
	    $result = $this->db->get_where('commodity_category',array('status'=>1))->result_array();
	    if(count($result)>0){
			echo json_encode(array('result'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('msg'=>'No record found.','status'=>500));
		}
	}
	
	function commodity_data(){
	    $group_id = $this->input->post('group_id');
	    $language = $this->session->userdata('language');
	    $this->db->select('ci.c_id,cc.cg_name,ci.commodity_name');
	    $this->db->join('commodity_category cc','cc.c_id = com.g_id','INNER');
	    $this->db->join('commodities_item ci','ci.com_id = com.c_id','INNER');
	    $this->db->where('ci.lang_id',$language);
	    $this->db->where('cc.c_id',$group_id);
	    $this->db->where('ci.status',1);
	    $result = $this->db->get_where('commodity com',array('com.status'=>1))->result_array();
	    
	    if(count($result)>0){
	        echo json_encode(array('result'=>$result,'msg'=>'commodity list.','status'=>200));
	    }
	    else{
	        echo json_encode(array('msg'=>'No record found.','status'=>500));
	    }
	}
	
	function comm_detail(){
		$c_id = (int)$this->input->post('c_id');
		$result = $this->db->query("select ci.c_id, ci.commodity_name,c.g_id from commodity c 
						join commodities_item ci on ci.com_id = c.c_id
						where c.c_id = (SELECT com_id from commodities_item where c_id = ".$c_id." and lang_id = 1 and status = 1)
						and c.status = 1")->result_array();
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'msg'=>'All record.','status'=>200));
		}
		else{
			echo json_encode(array('msg'=>'All record.','status'=>500));
		}
	}
     
        function comm_delete(){
                $this->db->select('com_id');
                $data = $this->db->get_where('commodities_item',array('c_id'=>$this->input->post('c_id')))->result_array();
				
              $this->db->where('c_id',$data[0]['com_id']);
             $result = $this->db->update('commodity',array('status'=>0));
              //print_r($this->db->last_query()); die;
             if($result){
                 echo json_encode(array('msg'=>'Operation successfull.','status'=>200));
             }
            else{
                 echo json_encode(array('msg'=>'Something wrong.','status'=>500));
            }
          }
	
          function comm_cat_delete(){
          	$comm_cat = $this->input->post('cat_id');
          	$this->db->where(array('c_id'=>$comm_cat));
          $result = 	$this->db->update('commodity_category',array('status'=>0));
          	//print_r($this->db->last_query()); die;
          	if($result){
          		echo json_encode(array('status'=>200,'msg'=>'Operation Successful'));
          	}
          	else{
          		echo json_encode(array('status'=>200,'msg'=>'Something Went Wrong'));
          	}
          }
          

         function comm_cat_check(){
          	$c_cat_name = $this->input->post('c_cat_name');
          	$result = $this->db->get_where('commodity_category',array('cg_name'=>$c_cat_name))->result_array();
          		
          		if(count($result)>0){
          			echo json_encode(array('status'=>500, 'msg'=>'This Commodity Category Already Exist'));
          		}
          		else{
          			echo json_encode(array('status'=>200));
          		}
          }
}