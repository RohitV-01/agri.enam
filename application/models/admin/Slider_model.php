<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider_model extends CI_Model {
	function __construct(){
		parent :: __construct();
		$this->load->database();
	}
	
	function slider_create($data){
		$val['sid'] = $data['sid'];
		$val['alt_tag'] = $data['alt_tag'];
		$val['sort'] = $data['slider_order'];
		$val['created_at'] = $data['created_at'];
		$val['created_by'] = $data['created_by'];

		//slider_item table data
		$val2['lang_id'] = $this->session->userdata('language');
		$val2['alt_tag'] = $data['alt_tag'];
		$val2['slider_image'] = $data['slider_image'];
		$val2['created_at'] = $data['created_at'];
		$val2['created_by'] = $data['created_by'];		
		
		$this->db->trans_begin();
		$this->db->insert('slider',$val);
		$val2['slider_id'] = $this->db->insert_id();
		$this->db->insert('slider_item',$val2);
		//print_r($this->db->last_query()); die;
				//-------------- log table---------------------
		$this->load->library('lang_file');
		$log_data['event_id'] = 27;
		$log_data['activity_id'] = $val2['slider_id'];
		$this->lang_file->logg_report($log_data);
		//----------------------------------------------------
				
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}
	}
	
	function slider_list(){
		$this->db->select('si.*,s.sort,s.publish');
		$this->db->join('slider_item si','si.slider_id=s.sid');
		$this->db->order_by('s.sort,s.created_at');
		$result=$this->db->get_where('slider s',array('s.status'=>1,'si.status'=>1))->result_array();
		return $result;
	}
	
	function slider_list_client(){
	    $l_id = $this->session->userdata('language');
		if($l_id == ''){
			$l_id = 1;
		}
// 	    		$this->db->select('si.*,s.sort,s.publish');
// 	    		$this->db->join('slider_item si','si.slider_id = s.sid');
// 	    		$this->db->order_by('s.sort,s.created_at');
// 	    		$result = $this->db->get_where('slider s',array('s.status'=>1,'s.publish'=>1,'si.lang_id'=>$l_id,'si.status'=>1))->result_array();
// 	    		print_r($this->db->last_query()); die;
	    
	    		$result = $this->db->query("(SELECT `si`.*, `s`.`sort`, `s`.`publish` FROM `slider` `s` JOIN `slider_item` `si` ON `si`.`slider_id` = `s`.`sid` 
                WHERE `s`.`status` = 1 
                AND `s`.`publish` = 1 
                AND `si`.`lang_id` = 1 
                AND `si`.`status` = 1 
                AND si.slider_id NOT IN 
                	(SELECT `si`.slider_id FROM `slider` `s` JOIN `slider_item` `si` ON `si`.`slider_id` = `s`.`sid` 
                		WHERE `s`.`status` = 1 
                			AND `s`.`publish` = 1 
                			AND `si`.`lang_id` = ".$l_id."
                			AND `si`.`status` = 1 )
                ORDER BY `s`.`sort`, `s`.`created_at`)
                
                UNION 
                (SELECT `si`.*, `s`.`sort`, `s`.`publish` FROM `slider` `s` JOIN `slider_item` `si` ON `si`.`slider_id` = `s`.`sid` 
                		WHERE `s`.`status` = 1 
                			AND `s`.`publish` = 1 
                			AND `si`.`lang_id` = ".$l_id."
                			AND `si`.`status` = 1)")->result_array();
	    
	    return $result;
	}
	
	
	function slider_update($data){
		$this->db->trans_begin();
		$this->db->select('slider_id');
		$result = $this->db->get_where('slider_item',array('s_id'=>$data['sid'],'lang_id'=>(int)$this->session->userdata('language'),'status'=>1))->result_array();
		
		$this->db->select('s_id');
		$result1 = $this->db->get_where('slider_item',array('slider_id'=>$result[0]['slider_id'],'lang_id'=>(int)$this->session->userdata('language'),'status'=>1))->result_array();
		
		if(count($result) > 0){
			$this->db->where(array('sid'=>$result[0]['slider_id']));
			if(isset($data['slider_image'])){
				$this->db->update('slider',array(
						'alt_tag' => $data['alt_tag'],
						'sort' => $data['slider_order'],
						'updated_at' => $data['created_at'],
						'updated_by' => $data['created_by']
				));
			}
			else{
				$this->db->update('slider',array(
						'alt_tag' => $data['alt_tag'],
						'sort' => $data['slider_order'],
						'updated_at' => $data['created_at'],
						'updated_by' => $data['created_by']
				));
			}
				
			if(isset($data['slider_image'])){
				$this->db->where(array('s_id'=>$result1[0]['s_id']));
				$this->db->update('slider_item',array(
						'alt_tag' => $data['alt_tag'],
						'slider_image' => $data['slider_image'],
						'updated_at' => $data['created_at'],
						'updated_by' => $data['created_by']
				));
			}
			else{ 
				$this->db->where(array('s_id'=>$result1[0]['s_id']));
				$this->db->update('slider_item',array(
						'alt_tag' => $data['alt_tag'],
						'updated_at' => $data['created_at'],
						'updated_by' => $data['created_by']
				));
			}
	
		}
		$this->db->select('slider_id');
		$activity = $this->db->get_where('slider_item',array('s_id'=>$data['sid']))->result_array();
	
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}	
	}
	
	function slider_publish($data){
		$this->db->trans_begin();
		//-------------- log table---------------------
	    if($data['status'] == 1){
	        $this->load->library('lang_file');
	        $log_data['event_id'] = 53;
	        $log_data['activity_id'] = $data['s_id'];
	        $this->lang_file->logg_report($log_data);
	    }else{
	        $this->load->library('lang_file');
	        $log_data['event_id'] = 54;
	        $log_data['activity_id'] = $data['s_id'];
	        $this->lang_file->logg_report($log_data);
	    }
	    //----------------------------------------------
		$result = $this->db->get_where('slider_item',array('s_id'=>$data['s_id'],'status'=>1))->result_array();
		
		$this->db->where('sid',(int)$result[0]['slider_id']);
		$this->db->update('slider',array('publish'=>$data['status']));
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}	
	}
	
	function slider_delete($data){
		$this->db->trans_begin();
		
		$result = $this->db->get_where('slider_item',array('s_id'=>$data['s_id'],'status'=>1))->result_array();
		
		$this->db->where('sid',(int)$result[0]['slider_id']);
		$this->db->update('slider',array('status'=>0));
		////////////////////ACTIVITY INSERT////////////////////////
		$this->db->select('slider_id');
		$activity = $this->db->get_where('slider_item',array('s_id'=>$data['s_id']))->result_array();
		
		//-------------- log table---------------------
		$this->load->library('lang_file');
		$log_data['event_id'] = 29;
		$log_data['activity_id'] = $activity[0]['slider_id'];
		$this->lang_file->logg_report($log_data);
		//----------------------------------------------------
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else{
			$this->db->trans_commit();
			return true;
		}	
	}
	
	
	function slider_create_subadmin($data){
		$this->db->trans_begin();
		
		$this->db->select('slider_id');
		$result = $this->db->get_where('slider_item',array('s_id'=>$data['s_id']))->result_array();
		
		$this->db->select('*');
		$result1 = $this->db->get_where('slider_item',array('slider_id'=>$result[0]['slider_id'],'lang_id'=>$this->session->userdata('language'),'status'=>1))->result_array();
		
		if(count($result1) > 0){
			// update
			if((isset($data['slider_image']))){
				$this->db->where('s_id',$result1[0]['s_id']);
				$this->db->update('slider_item',array(
						'alt_tag' => $data['slider_tag_popup'],
						'updated_at' =>date('y-m-d h:i:s'),
						'slider_image' => $data['slider_image'],
						'updated_by' =>$this->session->userdata('user_id')
				));
				$this->db->where('sid',$result[0]['slider_id']);
				$this->db->update('slider',array('sort'=>$data['sort']));
			}
			else{
				$this->db->where('s_id',$result1[0]['s_id']);
				$this->db->update('slider_item',array(
						'alt_tag' => $data['slider_tag_popup'],
						'updated_at' =>date('y-m-d h:i:s'),
						'updated_by' =>$this->session->userdata('user_id')
				));
				$this->db->where('sid',$result[0]['slider_id']);
				$this->db->update('slider',array('sort'=>$data['sort']));

				//-------------- log table---------------------
				$this->load->library('lang_file');
				$log_data['event_id'] = 28;
				$log_data['activity_id'] = $result[0]['slider_id'];
				$this->lang_file->logg_report($log_data);
				//----------------------------------------------------			}
				if ($this->db->trans_status() === FALSE){
					$this->db->trans_rollback();
					return false;
				}
				else{
					$this->db->trans_commit();
					return true;
				}	
			}
		}	
		else{
			//create
			if((isset($data['slider_image']))){
				$val['lang_id'] = (int)$this->session->userdata('language');
				$val['slider_id'] = (int)$result[0]['slider_id'];
				$val['alt_tag'] = $data['slider_tag_popup'];
				$val['slider_image'] = $data['slider_image'];
				$val['created_at'] = date('y-m-d h:i:s');
				$val['created_by'] = $this->session->userdata('user_id');
			}
			else{
				$val['lang_id'] = (int)$this->session->userdata('language');
				$val['slider_id'] = (int)$result[0]['slider_id'];
				$val['alt_tag'] = $data['slider_tag_popup'];
				$val['created_at'] = date('y-m-d h:i:s');
				$val['created_by'] = $this->session->userdata('user_id');
			}
			$this->db->insert('slider_item',$val);

			//-------------- log table---------------------
			$this->load->library('lang_file');
			$log_data['event_id'] = 27;
			$log_data['activity_id'] = $this->db->insert_id();
			$this->lang_file->logg_report($log_data);
			//----------------------------------------------------			
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return false;
			}
			else{
				$this->db->trans_commit();
				return true;
			}	
		}
	}
	
}
