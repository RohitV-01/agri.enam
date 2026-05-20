<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pop_up_model extends CI_Model {
	function __construct(){
		parent :: __construct();
		$this->load->database();
	}
	
	function popup_create($data){

		//print_r($data);exit;
		$val['popup_content'] = $data['popup_content'];
		$val['created_at'] = $data['created_at'];
		$val['created_by'] = $data['user_id'];
		$val['sort'] = $data['sort'];
		
		$this->db->trans_begin();
		
		$this->db->insert('popup',$val);   //// insert news
			
		$val2['popup_id'] = $this->db->insert_id();
		$val2['lang_id'] = 1;
		$val2['lang_id'] = 1;
		$val2['title'] = $data['notice_title'];
		$val2['popup_content'] = $data['popup_content'];
		$val2['created_at'] = $data['created_at'];
		$val2['created_by'] = $data['user_id'];
		
		$this->db->insert('popup_item',$val2);  //// insert news language table
		$news_id = $this->db->insert_id();
		$this->db->select('*');
		$result = $this->db->get_where('popup_item',array('id'=>$this->db->insert_id()))->result_array();
		
		//-------------- log table---------------------
		$this->load->library('lang_file');
		$log_data['event_id'] = 18;
		$log_data['activity_id'] = $news_id;
		$this->lang_file->logg_report($log_data);
		//----------------------------------------------------
			
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else {
			$this->db->trans_commit();
			return $result;
		}
	}
	
	function popup_update($data){
		//print_r($data);exit;
		$this->db->trans_begin();
		$group = $this->session->userdata('group_name');
		if($group != 'admin' && $group != 'developer'){
			/// language admin section
			$this->db->select('popup_id');
			$result = $this->db->get_where('popup_item',array('id' => $data['notice_id'],'status' => 1))->result_array();
			
			$news = array();
			if(count($result)>0){
				$this->db->select('*');
				$news = $this->db->get_where('popup_item',array('lang_id'=>$data['lang_id'],'popup_id' => $result[0]['popup_id'],'status' => 1))->result_array();
			}
			
			if(count($news) > 0){
				$this->db->where('id',$news[0]['id']);
				$this->db->update('popup_item',array(
					'title' => $data['notice_title'],
					'popup_content' => $data['popup_content'],
					'updated_at' =>  $data['created_at'],
					'updated_by' => $data['user_id']
				));
			}
			else {
				$this->db->insert('popup_item',array(
					'popup_id' => $result[0]['popup_id'],
					'lang_id' => $data['lang_id'],
					'title' => $data['notice_title'],
					'popup_content' => $data['popup_content'],
					'created_at' =>  $data['created_at'],
					'created_by' => $data['user_id']
				));
			}
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return false;
			}
			else {
				$this->db->trans_commit();
				return $result;
			}
		}
		else{
			/// admin section
				$this->db->where('id',$data['notice_id']);
				$this->db->update('popup_item',array(
					'title' => $data['notice_title'],
					'popup_content' => $data['popup_content'],
					'updated_at' => $data['created_at'],
					'updated_by' => $data['user_id']
				));
				
				$this->db->query("update popup set updated_at = '".$data['created_at']."',updated_by=".$data['user_id'].",sort=".$data['sort']." where id = (select popup_id from popup_item where id=".$data['notice_id'].")");
				
				//-------------- log table---------------------
				$this->load->library('lang_file');
				$log_data['event_id'] = 19;
				$log_data['activity_id'] = $data['notice_id'];
				$this->lang_file->logg_report($log_data);
				//----------------------------------------------------				
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return false;
			}
			else {
				$this->db->trans_commit();
				return true;
			}
		}
	}
	
	function popup_list(){
		$this->db->select('pi.*,p.sort,p.publish');
		$this->db->join('popup_item pi','pi.popup_id = p.id','left');
		$this->db->join('languages l','l.l_id = pi.lang_id','left');
		$this->db->order_by('p.sort,p.created_at,p.updated_at','ASC');
		$result = $this->db->get_where('popup p',array('p.status' => 1,'pi.status'=>1))->result_array();
			return $result;
	}
	

	function popup_notice_list(){
		$sql = "SELECT pi.title, pi.popup_content, pi.status, p.publish FROM popup_item pi
			INNER JOIN popup p ON pi.popup_id = p.id
			WHERE p.publish = 1 AND p.status = 1
			ORDER BY p.sort";

		$result = $this->db->query($sql);
		return $result->result_array();
	}
	
	function get_popup_content($data){
		$this->db->select('pi.*,p.sort');
		$this->db->join('popup p','p.id = pi.popup_id');
		$result = $this->db->get_where('popup_item pi',array('pi.popup_id'=>$data['popup_id'],'pi.lang_id'=>$data['lang_id'],'pi.status'=>1))->result_array();
		
		if(count($result)>0){
			
		}else{
			$this->db->select('pi.*,p.sort');
			$this->db->join('popup p','p.id = pi.popup_id');
			$result = $this->db->get_where('popup_item pi',array('pi.popup_id'=>$data['popup_id'],'pi.lang_id'=>1,'pi.status'=>1))->result_array();
		}
		return $result;
	}
	
	function popup_publish($data){
		$this->db->trans_begin();
	    //-------------- log table---------------------
	    if($data['status'] == 1){
	        $this->load->library('lang_file');
	        $log_data['event_id'] = 45;
	        $log_data['activity_id'] = $data['popup_id'];
	        $this->lang_file->logg_report($log_data);
	    }else{
	        $this->load->library('lang_file');
	        $log_data['event_id'] = 46;
	        $log_data['activity_id'] = $data['popup_id'];
	        $this->lang_file->logg_report($log_data);
	    }
	    //----------------------------------------------
		$this->db->where('id',$data['popup_id']);
		$this->db->update('popup',array('publish'=>$data['status']));
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else {
			$this->db->trans_commit();
			return true;
		}
	}
	
	function popup_delete($data){
		$this->db->trans_begin();
		
		$this->db->where('id',$data['popup_id']);
		$this->db->update('popup',array('status'=>0));
		
		//-------------- log table---------------------
		$this->load->library('lang_file');
		$log_data['event_id'] = 20;
		$log_data['activity_id'] = $data['popup_id'];
		$this->lang_file->logg_report($log_data);
		//----------------------------------------------------
				
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else {
			$this->db->trans_commit();
			return true;
		}
	}

	function notification_create($data){
		$val['mn_title'] = $data['msg_title'];
		$val['mn_message'] = $data['msg_body'];
		$val['createdon'] = $data['created_at'];
		$val['createdby'] = $data['user_id'];
		$val['mn_fromDate'] = $data['from_date'];
		$val['mn_toDate'] = $data['to_date'];
		$val['mn_lang'] = $data['lang_id'];
        $val['mn_display_order'] = $data['mn_display_order'];
		$this->db->trans_begin();
		
        $this->db->select('*');
		$data_1 = $this->db->get_where('mobile_notification',array('mn_display_order'=>$data['mn_display_order']))->result_array();

        if(count($data_1)>0){
            $msg=0;
            return $msg;
        }
        else{
		$this->db->insert('mobile_notification',$val);  
		$msg_id = $this->db->insert_id();		
		//-------------- log table---------------------
		$this->load->library('lang_file');
		$log_data['event_id'] = 18;
		$log_data['activity_id'] = $msg_id;
		$this->lang_file->logg_report($log_data);
		//----------------------------------------------------
			
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else {
			$this->db->trans_commit();
			return $msg_id;
		}
	    }
    }


	function notification_list(){
		$this->db->select('*');
		$result = $this->db->get_where('mobile_notification')->result_array();
		return $result;
	}

    function get_notification_content($data){
		$this->db->select('*');
		$result = $this->db->get_where('mobile_notification pi',array('pi.mn_tranid'=>$data['mn_tranid']))->result_array();
		return $result;
		if(count($result)>0){
			
		}else{
			$this->db->select('*');
		$result = $this->db->get_where('mobile_notification pi',array('pi.mn_tranid'=>$data['mn_tranid']))->result_array();
		return $result;
		}
		return $result;
	}

    function notification_update($data){
        $this->db->trans_begin();
		$group = $this->session->userdata('group_name');
		if($group != 'admin' && $group != 'developer'){
			/// language admin section
			$this->db->select('mn_tranid');
			$result = $this->db->get_where('mobile_notification',array('mn_tranid' => $data['mn_tranid']))->result_array();
			
			$news = array();
			if(count($result)>0){
				$this->db->select('*');
				$news = $this->db->get_where('mobile_notification',array('mn_tranid' => $data['mn_tranid']))->result_array();
			}
            if(count($news) > 0){
				$this->db->where('mn_tranid',$news[0]['mn_tranid']);
				$this->db->update('mobile_notification',array(
					'mn_title' => $data['mn_title'],
					'mn_message' => $data['msg_body'],
					'createdby' =>  $data['user_id'],
					'createdon' => $data['created_at'],
					'mn_fromDate' => $data['from_date'],
					'mn_toDate' => $data['to_date'],
                    'mn_lang' => $data['lang_id'],
					'mn_display_order' => $data['mn_display_order']
                   
				));
			}
			else {
				$this->db->insert('mobile_notification',array(
					'mn_tranid' => $result[0]['mn_tranid'],
					'mn_title' => $data['mn_title'],
					'mn_message' => $data['msg_body'],
					'createdby' =>  $data['user_id'],
					'createdon' => $data['created_at'],
					'mn_fromDate' => $data['from_date'],
					'mn_toDate' => $data['to_date'],
                    'mn_lang' => $data['lang_id'],
					'mn_display_order' => $data['mn_display_order']
				));
			}
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return false;
			}
			else {
				$this->db->trans_commit();
				return $result;
			}
        }else{
			
			//admin section
			$this->db->where('mn_tranid',$data['msg_id']);
			$this->db->update('mobile_notification',array(
				    'mn_tranid' => $data['msg_id'],
					'mn_title' => $data['msg_title'],
					'mn_message' => $data['msg_body'],
					'createdby' =>  $data['user_id'],
					'createdon' => $data['created_at'],
					'mn_fromDate' => $data['from_date'],
					'mn_toDate' => $data['to_date'],
                    'mn_lang' => $data['lang_id'],
					'mn_display_order' => $data['mn_display_order']
			));
						
			//-------------- log table---------------------
			$this->load->library('lang_file');
			$log_data['event_id'] = 19;
			$log_data['activity_id'] = $data['msg_id'];
			$this->lang_file->logg_report($log_data);
			//----------------------------------------------------				
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				return false;
			}
			else {
				$this->db->trans_commit();
				return true;
			}
		}
    }



    function notification_delete($data){
		$this->db->trans_begin();
		
		$this->db->where('mn_tranid',$data['mn_tranid']);
		$this->db->delete('mobile_notification');
		
		//-------------- log table---------------------
		$this->load->library('lang_file');
		$log_data['event_id'] = 20;
		$log_data['activity_id'] = $data['mn_tranid'];
		$this->lang_file->logg_report($log_data);
		//----------------------------------------------------
				
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else {
			$this->db->trans_commit();
			return true;
		}
	}


    function notification_publish($data){
		$this->db->trans_begin();
	    //-------------- log table---------------------
	    if($data['status'] == 1){
	        $this->load->library('lang_file');
	        $log_data['event_id'] = 45;
	        $log_data['activity_id'] = $data['mn_tranid'];
	        $this->lang_file->logg_report($log_data);
	    }else{
	        $this->load->library('lang_file');
	        $log_data['event_id'] = 46;
	        $log_data['activity_id'] = $data['mn_tranid'];
	        $this->lang_file->logg_report($log_data);
	    }
	    //----------------------------------------------
		$this->db->where('mn_tranid',$data['mn_tranid']);
		$this->db->update('mobile_notification',array('mn_publish'=>$data['status']));
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			return false;
		}
		else {
			$this->db->trans_commit();
			return true;
		}
	}
}
?>
