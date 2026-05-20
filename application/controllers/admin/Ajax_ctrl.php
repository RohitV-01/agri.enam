<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->library(array('session','ion_auth'));
		$this->load->database();
		$this->load->model(array('admin/Language_model','admin/Users_model','admin/Widget_model'));
		$this->lang->load('admin_lang', 'english');
		if (!$this->ion_auth->logged_in()){
			redirect('admin/admin');
		}
	}
	
	function get_all_widgets(){
		$page_id = $this->input->post('page_id');
		
		$this->db->select('*');
		$widgets = $this->db->get_where('widgets',array('status'=>1))->result_array();
		
		if(count($widgets) > 0){
			if($page_id){
				$this->db->select('page_layout');
				$result = $this->db->get_where('pages',array('p_id'=>$page_id,'status'=>1))->result_array();
				if($result[0]['page_layout'] == 2){
					$this->db->select('*');
					$layout = $this->db->get_Where('page_components',array('page_id'=>$page_id,'status'=>1))->result_array();
					if(count($layout) > 0){
						echo json_encode(array('data'=>$widgets,'data2'=>$layout,'status'=>200));
					}
					else{
						echo json_encode(array('data'=>$widgets,'data2'=>$layout,'msg'=>'No component is added in this page.','status'=>200));
					}
				}
				
				if($result[0]['page_layout'] == 1){
					$this->db->select('*');
					$layout = $this->db->get_Where('page_components',array('page_id'=>$page_id,'status'=>1))->result_array();
					if(count($layout) > 0){
						echo json_encode(array('data'=>$widgets,'data2'=>$layout,'status'=>200));
					}
					else{
						echo json_encode(array('data'=>$widgets,'data2'=>$layout,'msg'=>'No component is added in this page.','status'=>200));
					}
				}
				
				if($result[0]['page_layout'] == 3){
					$this->db->select('*');
					$layout = $this->db->get_Where('page_components',array('page_id'=>$page_id,'status'=>1))->result_array();
					if(count($layout) > 0){
						echo json_encode(array('data'=>$widgets,'data2'=>$layout,'status'=>200));
					}
					else{
						echo json_encode(array('data'=>$widgets,'data2'=>$layout,'msg'=>'No component is added in this page.','status'=>200));
					}
				}
			}
			else{
				echo json_encode(array('data'=>$widgets,'msg'=>'All Widgets.','status'=>200));
			}
		}
		else{
			echo json_encode(array('msg'=>'No Record Found.','status'=>500));
		}
	}
	
	
	function get_all_language(){
		$result = $this->Language_model->get_all_language();
		if(count($result) > 0){
			echo json_encode(array('data'=>$result,'msg'=>'All Languages.','status'=>200));
		}
		else{
			echo json_encode(array('msg'=>'No Record Found.','status'=>500));
		}
	}
	
	function get_all_apmcs(){
		$s_id = $this->input->post('s_id');
		$this->db->select('*');
		$result = $this->db->get_where('training_apmc',array('state_id'=>$s_id))->result_array();
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}
	
	function apmc_detail(){
		$data['state_id'] = (int)$this->input->post('s_id');
		$data['apmc_id'] = (int)$this->input->post('apmc_id');
		$data['round'] = (int)$this->input->post('round');
		$this->db->select('*');
		$result = $this->db->get_where('training_data',array('state_id'=>$data['state_id'],'apmc_id'=>$data['apmc_id'],'round'=>$data['round'],'status'=>1))->result_array();
		
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}
	
	function Check_page_name(){
		$str = $this->input->post('text');
		$this->db->select('*');
		$result = $this->db->get_where('pages',array('page_name'=>$str,'status'=>1))->result_array();
		
		if(count($result)>0){
			echo json_encode(array('status'=>500));
		}
		else{
			echo json_encode(array('status'=>200));
		}
	}
	
	function video_filter(){
		$l_id = $this->session->userdata('language');
		$data['sort'] = $this->input->post('sort');
		$data['is_home'] = $this->input->post('is_home');
		$data['publish'] = $this->input->post('publish');
		$data['title'] = $this->input->post('title');
		$data['page'] = $this->input->post('page');
		$data['category'] = $this->input->post('category');
		if($data['page'] == 1){
			$data['page'] = 0;
		}
		$this->db->select('vi.*,v.sort,v.v_url,v.publish,v.is_home,vc.category_name');
		$this->db->join('video v','v.v_id=vi.video_id','left');
		$this->db->join('video_category vc','vc.v_id = v.category_id');
		$this->db->order_by('v.sort',$data['sort']);
		if($data['is_home'] != '-1'){
			$this->db->where('v.is_home',(int)$data['is_home']);
		}
		if($data['category'] != '0'){
		    $this->db->where('vc.v_id',(int)$data['category']);
		}
		if($data['publish'] != '-1'){
			$this->db->where('v.publish',(int)$data['publish']);
		}
		if($data['title'] != ''){
			$this->db->like('vi.v_title',$data['title'],'both');
		}
		if($data['page'] != 0){
			$this->db->limit(10,(($data['page']*10)-10));
		}
		else{
			$this->db->limit(10,0);
		}
		$result = $this->db->where(array('v.status'=>1,'vc.status'=>1,'vi.status'=>1));
		$this->db->or_where(array('vi.lang_id'=>$l_id));
		$this->db->get('video_item vi')->result_array();	
		
		//************count***************//////////
		$this->db->select('vi.*,v.sort,v.v_url,v.publish,v.is_home,vc.category_name');
		$this->db->join('video v','v.v_id=vi.video_id');
		$this->db->join('video_category vc','vc.v_id = v.category_id');
		$this->db->order_by('v.sort',$data['sort']);
		if($data['category'] != '0'){
		    $this->db->where('vc.v_id',(int)$data['category']);
		}
		if($data['is_home'] != '-1'){
			$this->db->where('v.is_home',(int)$data['is_home']);
		}
		if($data['publish'] != '-1'){
			$this->db->where('v.publish',(int)$data['publish']);
		}
		if($data['title'] != ''){
			$this->db->like('vi.v_title',$data['title'],'both');
		}
		//$result1 = $this->db->get_where('video_item vi',array('v.status'=>1,'vi.lang_id' => $l_id,'vc.status'=>1,'vi.status'=>1))->result_array();	
		$result1 = $this->db->where(array('v.status'=>1,'vc.status'=>1,'vi.status'=>1));
		$this->db->or_where(array('vi.lang_id'=>$l_id));
		$this->db->get('video_item vi')->result_array();
		//************count******************/////////////
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'count'=>count($result1),'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}
	
	function news_filter(){
		if($this->session->userdata('group_name') == 'subadmin'){
			$l_id = 1;
		}
		else{
			$l_id = $this->session->userdata('language');
		}
		$data['sort'] 		= $this->input->post('sort');
		$data['publish'] 	= $this->input->post('publish');
		$data['title'] 		= $this->input->post('title');
		$data['page'] 		= $this->input->post('page');
		
		$this->db->select('ni.*,n.sort,n.publish');
		$this->db->join('news_item ni','ni.news_id = n.id','left');
		$this->db->join('languages l','l.l_id = ni.lang_id','left');
		if($data['publish'] != '-1'){
			$this->db->where('n.publish',(int)$data['publish']);
		}
		if($data['title'] != ''){
			$this->db->like('ni.news_contect',$data['title'],'both');
		}
		if($data['page'] != 0){
			$this->db->limit(10,(($data['page']*10)-10));
		}
		else{
			$this->db->limit(10,0);
		}
		$this->db->order_by('n.sort,n.created_at,n.updated_at',$data['sort']);
		$result = $this->db->get_where('news n',array('n.status' => 1,'ni.lang_id'=>$l_id,'ni.status'=>1))->result_array();
		//print_r($this->db->last_query()); die;
		//*************count*********************/////
		$this->db->select('ni.*,n.sort,n.publish');
		$this->db->join('news_item ni','ni.news_id = n.id','left');
		$this->db->join('languages l','l.l_id = ni.lang_id','left');
		if($data['publish'] != '-1'){
			$this->db->where('n.publish',(int)$data['publish']);
		}
		if($data['title'] != ''){
			$this->db->like('ni.news_contect',$data['title'],'both');
		}
		$this->db->order_by('n.sort,n.created_at,n.updated_at',$data['sort']);
		$result1 = $this->db->get_where('news n',array('n.status' => 1,'ni.lang_id'=>$l_id,'ni.status'=>1))->result_array();
		//*************count*********************/////
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'count'=>count($result1),'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}
	
	
	function quick_link_filter(){
		if($this->session->userdata('group_name') == 'subadmin'){
			$l_id = 1;
		}
		else{
			$l_id = $this->session->userdata('language');
		}
		$data['sort'] 		= $this->input->post('sort');
		$data['publish'] 	= $this->input->post('publish');
		$data['title'] 		= $this->input->post('title');
		$data['page'] 		= $this->input->post('page');
		
		$this->db->select('qli.*,ql.sort,ql.publish');
		$this->db->join('quick_links_item qli','qli.link_id = ql.id','left');
		$this->db->join('languages l','l.l_id = qli.lang_id','left');
		if($data['publish'] != '-1'){
			$this->db->where('ql.publish',(int)$data['publish']);
		}
		if($data['title'] != ''){
			$this->db->like('qli.link_contect',$data['title'],'both');
		}
		if($data['page'] != 0){
			$this->db->limit(10,(($data['page']*10)-10));
		}
		else{
			$this->db->limit(10,0);
		}
		$this->db->order_by('ql.sort,ql.created_at,ql.updated_at',$data['sort']);
		$result = $this->db->get_where('quick_links ql',array('ql.status' => 1,'qli.lang_id'=>$l_id,'qli.status'=>1))->result_array();
		
		//*************************count***************//////////
		$this->db->select('qli.*,ql.sort,ql.publish');
		$this->db->join('quick_links_item qli','qli.link_id = ql.id','left');
		$this->db->join('languages l','l.l_id = qli.lang_id','left');
		if($data['publish'] != '-1'){
			$this->db->where('ql.publish',(int)$data['publish']);
		}
		if($data['title'] != ''){
			$this->db->like('qli.link_contect',$data['title'],'both');
		}
		$this->db->order_by('ql.sort,ql.created_at,ql.updated_at',$data['sort']);
		$result1 = $this->db->get_where('quick_links ql',array('ql.status' => 1,'qli.lang_id'=>$l_id,'qli.status'=>1))->result_array();
		//*************************count***************//////////
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'count'=>count($result1),'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}
	
	function event_filter(){
		$l_id = $this->session->userdata('language');
		$data['sort'] 		= $this->input->post('sort');
		$data['publish'] 	= $this->input->post('publish');
		$data['title'] 		= $this->input->post('title');
		$data['page'] 		= $this->input->post('page');
		$data['cat'] 		= $this->input->post('cat');
		
		$l_id = $this->session->userdata('language');
		$this->db->select('ei.*,e.sort,e.event_image,e.publish,e.is_home,e.event_category');
		$this->db->join('event_item ei','ei.event_id = e.id','left');
		$this->db->join('languages l','l.l_id = ei.lang_id','left');
		if($data['cat'] != ''){
		    $this->db->where('e.event_category',$data['cat']);
		}
		if($data['publish'] != '-1'){
			$this->db->where('e.publish',(int)$data['publish']);
		}
		if($data['title'] != ''){
			$this->db->like('ei.title',$data['title'],'both');
		}
		if($data['page'] != 0){
			$this->db->limit(10,(($data['page']*10)-10));
		}
		else{
			$this->db->limit(10,0);
		}
		$this->db->order_by('e.sort,e.created_at',$data['sort']);
		$result = $this->db->get_where('events e',array('e.status' => 1,'ei.lang_id'=>$l_id,'ei.status'=>1))->result_array();
		//***********************count******************/////////////
		$this->db->select('ei.*,e.sort,e.event_image,e.publish,e.is_home,e.event_category');
		$this->db->join('event_item ei','ei.event_id = e.id','left');
		$this->db->join('languages l','l.l_id = ei.lang_id','left');
		if($data['cat'] != ''){
		    $this->db->where('e.event_category',$data['cat']);
		}
		if($data['publish'] != '-1'){
			$this->db->where('e.publish',(int)$data['publish']);
		}
		if($data['title'] != ''){
			$this->db->like('ei.title',$data['title'],'both');
		}
		$this->db->order_by('e.sort,e.created_at',$data['sort']);
		$result1 = $this->db->get_where('events e',array('e.status' => 1,'ei.lang_id'=>$l_id,'ei.status'=>1))->result_array();
		//***********************count******************/////////////
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'count'=>count($result1),'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}
}
