<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language_model extends CI_Model {
	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->database();
	}
	
	function get_all_language(){
		$this->db->select('*');
		$result = $this->db->get_Where('languages',array('status'=>1))->result_array();
		return $result;
	}
	
	function language_edit($data){
		$this->db->trans_begin();
		$this->db->select('l_eng');
		$res = 	$this->db->get_where('languages',array('l_id'=>$data['id']))->result_array();
		$this->db->where('l_id',$data['id']);
		$this->db->update('languages',array(
				'l_name'=>$data['name'],
				'l_eng'=>$data['l_eng'],
				'updated_at' => $data['updated_at'],
				'ip' => $data['ip'],
				'last_update_by' => $data['user_id']
				)
			);
		if($this->db->affected_rows()){
	    //--------------update log table---------------------
		    $this->load->library('lang_file');
		    $log_data['event_id'] = 6;
		    $log_data['activity_id'] = $data['id'];
		    $this->lang_file->logg_report($log_data);
		    //----------------------------------------------------
		    			
			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				return false;
			}
			else {
				$this->db->trans_commit();
				$msg = date('d-m-y h:i:s').' || user '.$this->session->userdata('identity').' update the language id '.$data['id'].PHP_EOL;
				return true;
			}
		}
		else{
			return false;
		}
	}
	
	function language_create($data){
		$this->db->insert('languages',$data);
		$id = $this->db->insert_id();
		$result = $this->db->get_where('languages',array('l_id'=>$id))->result_array();
		
//-----------update log table---------------------------
		$this->load->library('lang_file');
		$log_data['event_id'] = 5;
		$log_data['activity_id'] = $id;
		$this->lang_file->logg_report($log_data);
		//------------------------------------------------------		
		$data['menus'] = $this->get_all_language();
		return $result;
	}
	
	function language_delete($data){
		$this->load->helper('directory');
		$this->db->trans_begin();
		$this->db->where('l_id',$data['id']);
		$this->db->update('languages',array(
				'updated_at' => $data['updated_at'],
				'ip' => $data['ip'],
				'last_update_by' => $data['user_id'],
				'status' => 0
				)
			);
		
		//--------------update log table---------------------
		$this->load->library('lang_file');
		$log_data['event_id'] = 7;
		$log_data['activity_id'] = $data['id'];
		$this->lang_file->logg_report($log_data);
		//----------------------------------------------------
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return false;
		}
		else {
			$this->db->trans_commit();
			$data['languages'] = $this->Language_model->get_all_language();
			$data['menus'] = $this->get_all_language();
			return true;
		}
	}
	
	function language_check($data){
		$this->db->select('*');
		$result = $this->db->get_where('languages',array('l_name'=>$data['str']))->result_array();
		if(count($result) == 1){
			return false;
		}
		else{
			return true;
		}
	}
}
?>
