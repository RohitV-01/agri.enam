<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->database();
		$this->load->library(array('session','substring','excel'));
		$this->load->model(array('admin/Language_model','admin/Users_model','admin/Widget_model','Enam_model'));
	}

	function vivek()
	{
		date_default_timezone_set("Asia/Kolkata");
		echo date('Y-m-d');

	}
	
	function language_select(){
		$l_id = $this->input->post('l_id');
		
		$this->db->select('*');
		$result = $this->db->get_where('languages',array('l_id'=>$l_id))->result_array();
		
		$session_data = array(
			'client_language' => $l_id,
			'lang_folder' => $result[0]['l_eng']
		);
		$this->session->set_userdata($session_data);
		header('content-Type: application/json');
			echo json_encode(array('msg'=>'Language slected.','status'=>200));
		die;
	}
	
	function menu_activate(){
        $url_array = $this->input->post('text');
		$l_id = $this->session->userdata('client_language');
		$this->db->select('id,p_id,cms_url');
		$result = $this->db->get_where('menu',array('cms_url'=>$url_array,'status'=>1))->result_array();
		$brea = '';
		
		if(count($result)>0){
			if($result[0]['p_id']){
				$this->db->select('mi.menu_name,m.cms_url');
				$this->db->join('menu_item mi','mi.menu_id = m.id');
				$result1 = $this->db->get_where('menu m',array('m.id'=>$result[0]['p_id'],'mi.lang_id'=>$l_id,'m.status'=>1))->result_array();
				
				$brea = '<a href="'.base_url().$result1[0]['cms_url'].'">'.$result1[0]['menu_name'].' </a><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>';
				
				$this->db->select('mi.menu_name,m.cms_url');
				$this->db->join('menu_item mi','mi.menu_id = m.id');
				$result = $this->db->get_where('menu m',array('m.id'=>$result[0]['id'],'mi.lang_id'=>$l_id,'mi.status'=>1,'m.status'=>1))->result_array();
				//print_r($this->db->last_query()); die;
				$brea = $brea.' '.$result[0]['menu_name'];
			}
			//echo $brea; die;
		}
		else {
			$x = explode("/",$url_array);
			if(count($x)>1){
			$this->db->select('p.url,pi.title');
			$this->db->join('page_item pi','pi.page_id = p.p_id');
			$result = $this->db->get_where('pages p',array('url'=>$x[0],'pi.lang_id'=>$l_id,'pi.status'=>1))->result_array();
			$brea = '<a href="'.base_url().$result[0]['url'].'">'.$result[0]['title'].' </a><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>';	
			}
			$this->db->select('p.url,pi.title');
			$this->db->join('page_item pi','pi.page_id = p.p_id');
			$result1 = $this->db->get_where('pages p',array('url'=>$url_array,'pi.lang_id'=>$l_id,'pi.status'=>1))->result_array();
			
			$brea = $brea.' '.$result1[0]['title'];	
		}
		
		if($brea == ""){
			$this->db->select('mi.menu_name,m.cms_url');
			$this->db->join('menu_item mi','mi.menu_id = m.id');
			$result = $this->db->get_where('menu m',array('m.id'=>$result[0]['id'],'mi.lang_id'=>$l_id,'m.status'=>1))->result_array();

			//print_r($this->db->last_query());exit;
			
			$brea = $brea.' '.$result[0]['menu_name'];
			
			if(count($result)>0){
				echo json_encode(array('data'=>$result,'bredcrum'=>$brea,'status'=>200));
			}
			else{
				$url_array = ucwords(str_replace("-"," ",$url_array));
				echo json_encode(array('bredcrum'=>$url_array,'status'=>5000));
				exit();

			}
		}
		else{
			$url_array = ucwords(str_replace("-"," ",$url_array));
			echo json_encode(array('bredcrum'=>$brea,'status'=>5000));
		}
		
		
	}
	
	function get_all_states(){
		$this->db->select('*');
		$result = $this->db->get_where('training_state',array('status'=>1))->result_array();
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}
	
	function get_all_training_data(){
		$data['s_id'] = $this->input->post('s_id');
		$data['apmc_id'] = $this->input->post('apmc_id');
		$data['search']  = $this->input->post('search');
		
		if($data['search'] != '') {
			$this->db->select('ts.state_code,ts.name as state_name,ta.apmc_code,ta.name as apmc_name');
			$this->db->join('training_state ts','ts.state_code = ta.state_id');
			$this->db->like('ta.name',$data['search'],'after');
			$result = $this->db->get_where('training_apmc ta',array('ta.status'=>1))->result_array();
		}
		else { 
			$this->db->select('ts.state_code,ts.name as state_name,ta.apmc_code,ta.name as apmc_name');
			$this->db->join('training_state ts','ts.state_code = ta.state_id');
			if($data['s_id'] != 0 && $data['s_id'] != ''){
				$this->db->where('ts.state_code',$data['s_id']);		
			}
			if($data['apmc_id'] != 0 && $data['apmc_id'] != ''){
				$this->db->where('ta.apmc_code',$data['apmc_id']);
			}
			$result = $this->db->get_where('training_apmc ta',array('ta.status'=>1))->result_array();
		}
		
		$new_array = array();
		foreach($result as $r){
			$temp = $r;
			$this->db->select('*');
			$tempdata = $this->db->get_Where('training_data',array('state_id'=>$r['state_code'],'apmc_id'=>$r['apmc_code'],'status'=>1))->result_array();
			if(count($tempdata)>0){
				$temp['round'][1]['apmc_id'] = $tempdata[0]['apmc_id'];
				$temp['round'][1]['vendor'] = $tempdata[0]['vendor'];
				$temp['round'][1]['training_plan_date'] = $tempdata[0]['training_plan_date'];
				$temp['round'][1]['training_date'] = $tempdata[0]['training_date'];
				$temp['round'][1]['no_of_farmer_participated'] = $tempdata[0]['no_of_farmer_participated'];
				$temp['round'][1]['no_of_traders_participated'] = $tempdata[0]['no_of_traders_participated'];
				$temp['round'][1]['no_of_ca_participated'] = $tempdata[0]['no_of_ca_participated'];
				$temp['round'][1]['apmc_staff_participated'] = $tempdata[0]['apmc_staff_participated'];
				$temp['round'][1]['other_participants'] = $tempdata[0]['other_participants'];
				$temp['round'][1]['total_participants'] = $tempdata[0]['total_participants'];
				$temp['round'][1]['feedback_score'] = $tempdata[0]['feedback_score'];
				
				$temp['round'][2]['apmc_id'] = $tempdata[1]['apmc_id'];
				$temp['round'][2]['vendor'] = $tempdata[1]['vendor'];
				$temp['round'][2]['training_plan_date'] = $tempdata[1]['training_plan_date'];
				$temp['round'][2]['training_date'] = $tempdata[1]['training_date'];
				$temp['round'][2]['no_of_farmer_participated'] = $tempdata[1]['no_of_farmer_participated'];
				$temp['round'][2]['no_of_traders_participated'] = $tempdata[1]['no_of_traders_participated'];
				$temp['round'][2]['no_of_ca_participated'] = $tempdata[1]['no_of_ca_participated'];
				$temp['round'][2]['apmc_staff_participated'] = $tempdata[1]['apmc_staff_participated'];
				$temp['round'][2]['other_participants'] = $tempdata[1]['other_participants'];
				$temp['round'][2]['total_participants'] = $tempdata[1]['total_participants'];
				$temp['round'][2]['feedback_score'] = $tempdata[1]['feedback_score'];
			}
			$new_array[] = $temp;
		}
		
		if(count($result)>0){
			echo json_encode(array('data'=>$new_array,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
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
	
	function get_all_training_data_date(){
		$data['date1'] = $this->input->post('date1');
		$data['date2'] = $this->input->post('date2');
		$data['s_id'] = $this->input->post('state_id');
		$data['apmc_id'] = $this->input->post('apmc_id');
		$data['search_text'] = $this->input->post('search_text');
		
		if($data['search_text'] == ''){
			$this->db->select('td.*,ta.apmc_code,ts.name as state_name,ta.name as apmc_name');
			$this->db->join('training_apmc ta','ta.apmc_code = td.apmc_id');
			$this->db->join('training_state ts','ts.state_code = td.state_id');
			if($data['s_id'] != 0 && $data['s_id'] != ''){
				$this->db->where('td.state_id',$data['s_id']);
			}
			if($data['apmc_id'] != 0 && $data['apmc_id'] != ''){
				$this->db->where('td.apmc_id',$data['apmc_id']);
			}
			$result = $this->db->get_Where('training_data td',array('td.status'=>1))->result_array();
			
			if($data['date1'] != '' && $data['date2'] != ''){
				$result = $this->db->query("SELECT `td`.*, `ta`.`apmc_code`, `ts`.`name` as `state_name`, `ta`.`name` as `apmc_name` FROM `training_data` `td` JOIN `training_apmc` `ta` ON `ta`.`apmc_code` = `td`.`apmc_id` JOIN `training_state` `ts` ON `ts`.`state_code` = `td`.`state_id` WHERE CAST(`td`.`training_date` AS datetime) >= CAST('".$data['date2']."' AS datetime) AND CAST(`td`.`training_date` AS datetime) <= CAST('".$data['date2']."' AS datetime) AND `td`.`status` = 1")->result_array();
			}
		}
		else{
			$this->db->select('*');
			$this->db->join('training_apmc ta','ta.apmc_code = td.apmc_id');
			$this->db->like('ta.name',$data['search_text'],'after');
			$result = $this->db->get_Where('training_data td',array('td.status'=>1))->result_array();
		}
		//print_r($this->db->last_query()); die;
		$apmc_ids = array();
		if(count($result)>0){
			foreach($result as $r){
				$apmc_ids[] = $r['apmc_code'];
			}
		}
		$apmc_ids = array_unique($apmc_ids);
		
		$this->db->select('ts.state_code,ts.name as state_name,ta.apmc_code,ta.name as apmc_name');
		$this->db->join('training_state ts','ts.state_code = ta.state_id');
		if(count($apmc_ids)>0){
			$this->db->where_in('ta.apmc_code',$apmc_ids);
		}
		$result = $this->db->get_where('training_apmc ta',array('ta.status'=>1))->result_array();
		
		$new_array = array();
		foreach($result as $r){
			$temp = $r;
			$this->db->select('*');
			$tempdata = $this->db->get_Where('training_data',array('state_id'=>$r['state_code'],'apmc_id'=>$r['apmc_code'],'status'=>1))->result_array();
			if(count($tempdata)>0){
				$temp['round'][1]['apmc_id'] = $tempdata[0]['apmc_id'];
				$temp['round'][1]['vendor'] = $tempdata[0]['vendor'];
				$temp['round'][1]['training_plan_date'] = $tempdata[0]['training_plan_date'];
				$temp['round'][1]['training_date'] = $tempdata[0]['training_date'];
				$temp['round'][1]['no_of_farmer_participated'] = $tempdata[0]['no_of_farmer_participated'];
				$temp['round'][1]['no_of_traders_participated'] = $tempdata[0]['no_of_traders_participated'];
				$temp['round'][1]['no_of_ca_participated'] = $tempdata[0]['no_of_ca_participated'];
				$temp['round'][1]['apmc_staff_participated'] = $tempdata[0]['apmc_staff_participated'];
				$temp['round'][1]['other_participants'] = $tempdata[0]['other_participants'];
				$temp['round'][1]['total_participants'] = $tempdata[0]['total_participants'];
				$temp['round'][1]['feedback_score'] = $tempdata[0]['feedback_score'];
		
				$temp['round'][2]['apmc_id'] = $tempdata[1]['apmc_id'];
				$temp['round'][2]['vendor'] = $tempdata[1]['vendor'];
				$temp['round'][2]['training_plan_date'] = $tempdata[1]['training_plan_date'];
				$temp['round'][2]['training_date'] = $tempdata[1]['training_date'];
				$temp['round'][2]['no_of_farmer_participated'] = $tempdata[1]['no_of_farmer_participated'];
				$temp['round'][2]['no_of_traders_participated'] = $tempdata[1]['no_of_traders_participated'];
				$temp['round'][2]['no_of_ca_participated'] = $tempdata[1]['no_of_ca_participated'];
				$temp['round'][2]['apmc_staff_participated'] = $tempdata[1]['apmc_staff_participated'];
				$temp['round'][2]['other_participants'] = $tempdata[1]['other_participants'];
				$temp['round'][2]['total_participants'] = $tempdata[1]['total_participants'];
				$temp['round'][2]['feedback_score'] = $tempdata[1]['feedback_score'];
			}
			$new_array[] = $temp;
		}
		
		if(count($new_array)>0){
			echo json_encode(array('data'=>$new_array,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}
	
	function commodity_parameter(){
		$data['id'] = $this->input->post('id');

		//print_r($data);exit;
		$data['language'] = $this->session->userdata('client_language');
// 		$this->db->select('*');
// 		$result = $this->db->get_Where('commodity_parameters',array('comm_id'=>(int)$data['id'],'lang_id'=>$data['language'],'status'=>1))->result_array();
		
		$this->db->select('cp.*,c.image as comm_image');
		$this->db->join('commodity c','c.c_id=cp.comm_id');
		$result = $this->db->get_where('commodity_parameters cp',array('cp.comm_id'=>(int)$data['id'],'cp.lang_id'=>$data['language'],'cp.status'=>1,'c.status'=>1))->result_array();
		
		$str = html_entity_decode($result[0]['comm_title']);
		$regex = "/\[(.*?)\]/";
		$data['output'] = $str;
		preg_match_all($regex, $str, $matches);
		
		for($i =0; $i < count($matches[1]); $i++){
		    $result[0]['comm_title'] = str_replace($matches[0][$i],$this->substring->image_path(),$result[0]['comm_desc']);
		}
		
		$str = html_entity_decode($result[0]['comm_desc']);
	
		$regex = "/\[(.*?)\]/";
		$data['output'] = $str;
		preg_match_all($regex, $str, $matches);
		for($i =0; $i < count($matches[1]); $i++){
			$result[0]['comm_desc'] = str_replace($matches[0][$i],$this->substring->image_path(),$result[0]['comm_desc']);
		}
	
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}
	
	function get_district_map(){
		$data['state_id'] = $this->input->post('state_id');
		$data['language'] = $this->session->userdata('client_language');
		
		$this->db->select('s.state_name,d.*');
		$this->db->join('states s','s.state_id = d.state_id');
                $this->db->order_by('d.district_name','asc');
		$result = $this->db->get_where('district d',array('d.state_id'=>$data['state_id']))->result_array();
		
		$reult_count = $this->db->query("select count(*) as total from mandis m join (SELECT s.state_name,d.district_name,d.district_id,s.state_id,s.state_code FROM states s join district d on d.state_id = s.state_id AND s.state_id = ".$result[0]['state_id'].") as t1 on t1.district_name = m.district_name AND t1.state_code = m.state_code")->result_array();
					
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'count'=>$reult_count,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}
	
	function commodity_search(){
		$data['string'] = $this->input->post('string');
		$data['language'] = $this->session->userdata('client_language');
		
		$this->db->select('*');
		$this->db->like('commodity_name',$data['string'],'both');
		$this->db->group_by('commodity_id');
		$result = $this->db->get_Where('commodity',array('status'=>1))->result_array();
		
		if(count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}

       function hooks_fun(){
		$this->db->select('count(*) as visitors');
		$result = $this->db->get_where('visitor_count',array('status'=>1))->result_array(); //print_r($result);
		if(count($result)>0){

			echo json_encode(array('data'=>$result[0]['visitors'],'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
		
	}


              function states_name(){
		$this->db->select('state_name,state_id');
                $this->db->order_by('state_name','ASC');
		$result = $this->db->get_Where('states',array('status'=>1))->result_array();
               if(count($result)>0){

			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}

          function state_namedetail(){
            $this->db->select('DISTINCT(state) as state');
			$this->db->order_by('state','ASC');
			$result = $this->db->get('mandi_contact_details')->result_array();
			if(count($result)>0){
				echo json_encode(array('data'=>$result,'status'=>200));
			}
			else{
				echo json_encode(array('status'=>500));
			}
        }


        
         function districts_name(){
		$state_id = $this->input->post('state_id');
		$this->db->select('district_name,district_id');
                $this->db->order_by('district_name','ASC');
		$result = $this->db->get_Where('district',array('status'=>1,'state_id'=>$state_id))->result_array();
               if(count($result)>0){

			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}
        

        function district_name_detail(){ 
	$state_name= $this->input->post('state_id');

        $this->db->select('distinct(district)');
        $this->db->order_by('district','ASC');
        $result = $this->db->get_where('mandi_contact_details',array('state'=>$state_name))->result_array();
        if(count($result)>0){

			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		} 

        }
 
      
      
         function mandis_name(){
		$state_code = $this->input->post('state_code');
                $district = $this->input->post('district');

		$this->db->select('m.*');
                $this->db->join('states s','s.state_code = m.state_code');
                $this->db->order_by('mandi_name','ASC');
		$result = $this->db->get_Where('mandis m',array('m.status'=>1,'m.district_name'=>$district))->result_array();

               if(count($result)>0){

			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}
    

        function mandi_namedetail(){
        $state_name = $this->input->post('state_code');
		$district = $this->input->post('district');
          
          $this->db->select('mandi_name');
$this->db->group_by('mandi_name');
          $result = $this->db->get_where('mandi_contact_details',array('state'=>$state_name,'district'=>$district))->result_array();
          if(count($result)>0){

			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
        }
       

    function mandi_name(){
                $mandi_id = $this->input->post('mandi_id');
                $state_name= $this->input->post('state_name');
                $district_name= $this->input->post('district_name');
                
				$this->db->select('distinct(created_at)');
				$this->db->order_by('created_at','desc');
				$this->db->limit(1);
				$max_date = $this->db->get_where('mandi_contact_details',array('status'=>1))->result_array();
				
                $this->db->select('*');
				//$this->db->where('created_at',$max_date[0]['created_at']);
                $result = $this->db->get_where('mandi_contact_details',array('state'=>$state_name,'district'=>$district_name,'mandi_name'=>$mandi_id,'status'=>1))->result_array();
               if(count($result)>0){
               
			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}

	function mandi_count(){
		$state = $this->input->post('state');
		$district = $this->input->post('district');
		$mandi = $this->input->post('mandi');

$this->db->select('cast(created_at as date) created_at');
$this->db->order_by('created_at','DESC');
$this->db->limit(1);
$max_date = $this->db->get_where('mandi_contact_details',array('status'=>1))->result_array();

		if($state == "0" && $district == "0"){                    
                $result = $this->db->query("select * from mandi_contact_details where CAST(created_at as date) =".$max_date[0]['created_at']." group by mandi_name ASC")->result_array();
		}
		else if($state != "0" && $district == "0"){
                 $result = $this->db->query("select * from mandi_contact_details where CAST(created_at as date) ='".$max_date[0]['created_at']."' AND state = '". $state ."' group by mandi_name ASC")->result_array();
		}

		if(count($result)>0){
			echo json_encode(array('count'=>count($result),'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}

        function mandicount(){
          $this->db->select('sum(total) as total,created_at');
          $this->db->group_by('created_at');
          $this->db->order_by('created_at','desc');
          $this->db->limit(1);
          $result = $this->db->get('stackholder_data')->result_array();
          if(count($result)>0){
			echo json_encode(array('count'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
        }

        function mandidetail_enam(){
         $state_id = $this->input->post('state_id');
		 $date = $this->db->query("select DISTINCT(created_at) as created_at from stackholder_data ORDER by created_at DESC LIMIT 1")->result_array();
		 
         $this->db->select('*');
         $result = $this->db->get_where('stackholder_data',array('state_id'=>$state_id,'created_at'=>$date[0]['created_at']))->result_array();
		 
         if(count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
        }

         function dist_list(){
           $state_id = (int)$this->input->post('state_id');
           $this->db->select('distinct(d_id) as d_id,district_name');
           $result = $this->db->get_where('district',array('state_id'=>$state_id))->result_array();

         if(count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
        } 

             
        function apmc_list(){
           $state_id = (int)$this->input->post('state_id');
           $this->db->select('distinct(apmc_id) as apmc_id,apmc_name');
           $result = $this->db->get_where('mandis',array('state_id'=>$state_id))->result_array();

         if(count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
        } 

        function commodity_list(){
			$stateName = $this->input->post('stateName');
			$apmcName = $this->input->post('apmcName');
			$from_date = $this->input->post('fromDate');
			$to_date = $this->input->post('toDate');

			//print_r($_POST);exit;


			if($stateName == "-- All --"){
				/*$result = $this->db->query("select * from trade_data WHERE  created_at >= '".$from_date."' AND created_at <= '".$to_date."' GROUP by commodity")->result_array();*/

				$sql = "SELECT * from trade_data WHERE created_at >= ? AND created_at <= ? GROUP by commodity";
				$result = $this->db->query($sql, array($from_date , $to_date))->result_array();				
			}

			elseif($apmcName == "-- Select APMCs --"){
				/*$result = $this->db->query("select * from trade_data WHERE state = '".$stateName."' AND created_at >= '".$from_date."' AND created_at <= '".$to_date."' GROUP by commodity")->result_array();*/

				$sql = "SELECT * from trade_data WHERE state = ? AND created_at >= ? AND created_at <= ? GROUP by commodity";
				
				$result = $this->db->query($sql, array($stateName , $from_date , $to_date))->result_array();

				
			}


			else

			{
				/*$result = $this->db->query("select * from trade_data WHERE state = '".$stateName."' AND apmc = '".$apmcName."' AND created_at >= '".$from_date."' AND created_at <= '".$to_date."' GROUP by commodity")->result_array();*/
				$sql = "SELECT * from trade_data WHERE state = ? AND apmc = ? AND created_at >= ? AND created_at <= ? GROUP by commodity";
				$result = $this->db->query($sql, array($stateName , $apmcName , $from_date , $to_date))->result_array();


				
			}
			if(count($result)>0){
				echo json_encode(array('data'=>$result,'status'=>200));
			}
			else{
				echo json_encode(array('status'=>500));
			}
        }
		
		function trade_data_list(){
			//print_r($_POST);exit;
			$stateName = $this->input->post('stateName');
			$apmcName = $this->input->post('apmcName');
			$commodity = $this->input->post('commodityName');
			$districtName = $this->input->post('districtName');
			$from_date = $this->input->post('fromDate');
			$to_date = $this->input->post('toDate');
            $result = array();        
            if($stateName == "-- All --" && $apmcName == "-- Select APMCs --" && $commodity == "-- Select Commodity --"){
				/*$result = $this->db->query("select * from trade_data WHERE created_at >= '".$from_date."' AND created_at <= '".$to_date."' group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC, state ASC, apmc ASC,created_at DESC")->result_array();*/

				$sql = "SELECT * from trade_data WHERE created_at >= ? AND created_at <= ? group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC, state ASC, apmc ASC,created_at DESC";
				
				$result = $this->db->query($sql, array($from_date ,$to_date))->result_array();

			}
			else if($stateName != "-- All --" && $apmcName == "-- Select APMCs --" && $commodity == "-- Select Commodity --"){
				if(isset($districtName) && $districtName != '-- Select District --'){
					/*$result = $this->db->query("select * from trade_data WHERE 
								state = '".$stateName."' 
								AND apmc in (SELECT mandi_name FROM `mandi_contact_details` WHERE state = '".$stateName."' AND district = '".$districtName."')
								AND created_at >= '".$from_date."' 
								AND created_at <= '".$to_date."' 
								group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at
								ORDER by commodity_traded DESC")->result_array();*/

					$sql = "SELECT * from trade_data WHERE state = ? AND apmc in (SELECT mandi_name FROM `mandi_contact_details` WHERE state = ? AND district = ?) AND created_at >= ? AND created_at <= ? group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at
								ORDER by commodity_traded DESC";
				
								$result = $this->db->query($sql, array($stateName , array($stateName , $districtName) , $from_date ,$to_date))->result_array();
				}
				else{
					/*$result = $this->db->query("select * from trade_data WHERE state = '".$stateName."' AND created_at >= '".$from_date."' AND created_at <= '".$to_date."' group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC,state ASC, apmc ASC,created_at DESC")->result_array();*/

					$sql = "SELECT * from trade_data WHERE state = ? AND created_at >= ? AND created_at <= ? group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC,state ASC, apmc ASC,created_at DESC";
				
					$result = $this->db->query($sql, array($stateName , $from_date , $to_date))->result_array();

				}
			}
			else if($stateName != "-- All --" && $apmcName != "-- Select APMCs --" && $commodity == "-- Select Commodity --"){
				if(isset($districtName) && $districtName != '-- Select District --'){
					/*$result = $this->db->query("select * from trade_data WHERE 
								state = '".$stateName."' 
								AND apmc in (SELECT mandi_name FROM `mandi_contact_details` WHERE state = '".$stateName."' AND district = '".$districtName."' AND mandi_name = '".$apmcName."')
								AND created_at >= '".$from_date."' 
								AND created_at <= '".$to_date."' 
								group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at
								ORDER by commodity_traded DESC")->result_array();*/

								$sql = "SELECT * from trade_data WHERE state = ? AND apmc in (SELECT mandi_name FROM `mandi_contact_details` WHERE state = ? AND district = ? AND mandi_name = ?)
								AND created_at >= ? AND created_at <= ?
								group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER by commodity_traded DESC";
				    			$result = $this->db->query($sql, array($stateName , array($stateName , $districtName , $apmcName) , $from_date ,$to_date))->result_array();
					
				}
				else{
					/*$result = $this->db->query("select * from trade_data WHERE state = '".$stateName."' AND apmc = '".$apmcName."' AND created_at >= '".$from_date."' AND created_at <= '".$to_date."' group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY  commodity_traded DESC,state ASC, apmc ASC,created_at DESC")->result_array();*/
					$sql = "SELECT * from trade_data WHERE state = ? AND apmc = ? AND created_at >= ? AND created_at <= ? group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY  commodity_traded DESC,state ASC, apmc ASC,created_at DESC";
				
					$result = $this->db->query($sql, array($stateName , $apmcName , $from_date , $to_date))->result_array();
										
				}
			}
			else if($stateName != "-- All --" && $apmcName != "-- Select APMCs --" && $commodity != "-- Select Commodity --"){
				/*$result = $this->db->query("select * from trade_data WHERE state = '".$stateName."' AND apmc = '".$apmcName."' AND commodity = '".$commodity."' AND created_at >= '".$from_date."' AND created_at <= '".$to_date."' group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC,state ASC, apmc ASC,created_at DESC")->result_array();*/

				$sql = "SELECT * from trade_data WHERE state = ? AND apmc = ? AND commodity = ? AND created_at >= ? AND created_at <= ? group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC,state ASC, apmc ASC,created_at DESC";
				
				$result = $this->db->query($sql, array($stateName , $apmcName , $commodity , $from_date ,$to_date))->result_array();


			}
            else if($stateName != "-- All --" && $apmcName == "-- Select APMCs --" && $commodity != "-- Select Commodity --"){
				/*$result = $this->db->query("select * from trade_data WHERE state = '".$stateName."' AND commodity = '".$commodity."' AND created_at >= '".$from_date."' AND created_at <= '".$to_date."' group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC, state ASC, apmc ASC,created_at DESC")->result_array();*/
				$sql = "SELECT * from trade_data WHERE state = ? AND commodity = ? AND created_at >= ? AND created_at <= ? group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC, state ASC, apmc ASC,created_at DESC";
				
				$result = $this->db->query($sql, array($stateName , $commodity , $from_date ,$to_date))->result_array();
			}

//////// written on dated 15 Jul 19 by SB
			else if($stateName = "-- All --" && $apmcName == "-- Select APMCs --" && $commodity != "-- Select Commodity --")
			{
				/*$result = $this->db->query("select * from trade_data WHERE  commodity = '".$commodity."' AND created_at >= '".$from_date."' AND created_at <= '".$to_date."' group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC, state ASC, apmc ASC,created_at DESC")->result_array();*/

				$sql = "SELECT * from trade_data WHERE  commodity = ? AND created_at >= ? AND created_at <= ? group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC, state ASC, apmc ASC,created_at DESC";
				
				$result = $this->db->query($sql, array($commodity , $from_date ,$to_date))->result_array();

				//print_r($this->db->last_query());exit;	
			}
/////
			//print_r($result);

			if(count($result)>0){
				echo json_encode(array('data'=>$result,'status'=>200));
			}
			else{
				echo json_encode(array('status'=>500));
			}
		}



function trade_data(){
		date_default_timezone_set("Asia/Kolkata");
        $data['language'] = 'en';
        $data['stateName'] = '';
        $data['apmcName'] = '';
        $data['commodityName'] = 'null';
        // $data['fromDate'] = '2018-10-23 00:00:00';
        // $data['toDate'] = '2018-10-23 23:59:59';
		$data['fromDate'] = date('Y-m-d', strtotime(date('Y-m-d') .' -1 day')).' 00:00:00';
        $data['toDate'] =   date('Y-m-d', strtotime(date('Y-m-d') .' -1 day')).' 23:59:59';
        
        $url = 'http://enam.gov.in/NamWebSrv/rest/CommodityPrice/getMinMaxModelPrice';

        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        
        $data_array =  json_decode($result, true); // returns array("foo" => "bar")
        unset($data_array['statusMsg']);
        $insert_data = array();
        foreach($data_array['listCommodity'] as $res){
            $temp = array();            
            $temp['state']              =  $res['stateName'];
            $temp['apmc']               =  $res['apmcName'];
            $temp['commodity']          =  $res['commodityName'];
            $temp['min_price']          =  $res['minPrice'];
            $temp['modal_price']        =  $res['modelPrice'];
            $temp['max_price']          =  $res['maxPrice'];
            $temp['commodity_arrivals'] =  $res['arrivalQty'];
            $temp['commodity_traded']   =  $res['soldQty'];
            $temp['commodity_Uom']   =  $res['commodityUom'];
            $temp['created_at']  = $data['toDate'];
            $insert_data[] = $temp;
        }
        $this->db->insert_batch('trade_data',$insert_data);
    }
	
	
function trade_data_ajax(){ 

		$date = $this->input->post('date');

		/*Functionality for delete start*/
		$condfordelete = "created_at='".$date."'";
		$checkdatewisedata = $this->db->get_where('trade_data',array('created_at'=>$date))->result_array();	
		if(count($checkdatewisedata)>0){
			$this->db->where($condfordelete);
			$this->db->delete('trade_data');
		}
		/*Functionality for delete END*/
		$result = $this->input->post('tradedata');

        $data_array =  json_decode($result,true); 
		$this->db->select('created_at');
		$this->db->limit(1);
		$result = $this->db->get_where('trade_data',array('created_at'=>$date))->result_array();
			//if(!count($result)){
			$insert_data = array();
			foreach($data_array['listCommodity'] as $res){
				$temp = array();            
				$temp['state']              =  $res['stateName'];
				$temp['apmc']               =  $res['apmcName'];
				$temp['commodity']          =  $res['commodityName'];
				$temp['min_price']          =  $res['minPrice'];
				$temp['modal_price']        =  $res['modelPrice'];
				$temp['max_price']          =  $res['maxPrice'];
				$temp['commodity_arrivals'] =  $res['arrivalQty'];
				$temp['commodity_traded']   =  $res['soldQty'];
				$temp['commodity_Uom']   =  $res['commodityUom'];
				$temp['created_at']  = $date;
				$insert_data[] = $temp;	
			}
			$this->db->insert_batch('trade_data',$insert_data);
			echo json_encode(array('msg'=>'Trade Data Submited Successfully.','status'=>200));
		//}
		//else{
			//echo json_encode(array('msg'=>'Trade Data already Submited.','status'=>201));
		//}
    }

 function trade_data_ajax_check(){
 	$date = $this->input->post('date');
 	
 	$this->db->select('created_at');
 	$this->db->limit(1);
 	$result = $this->db->get_where('trade_data',array('created_at'=>$date))->result_array();
 	if(count($result)>0){
 		echo json_encode(array('msg'=>'Trade Data Found on this date /n You want to re-fetch data?','status'=>201));
 	}
 	else{
 		echo json_encode(array('msg'=>'Trade Data already Submited.','status'=>200));
 	}
 }

function apmc_data(){
        $data['language'] = 'en';
        
        $url = 'http://enam.gov.in/NamWebSrv/rest/MastersUpdate/getApmc';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'GET',
                'content' => http_build_query($data),
            )
        );
        
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        
        $data_array =  json_decode($result, true); // returns array("foo" => "bar")
        unset($data_array['statusMsg']);
        $insert_data = array();
        foreach($data_array['listStateApmc'] as $res){
            $temp = array();            
            $temp['state_id']          = $res['stateId'];
            $temp['state_code']         =  $res['stateCode'];
            $temp['apmc_id']          =  $res['apmcId'];
            $temp['apmc_name']          =  $res['apmcDesc'];
            $temp['apmc_code']          =  $res['apmcCode'];
            $insert_data[] = $temp;
        }
        $this->db->insert_batch('mandis',$insert_data);
    }
	
	function update_stackholder(){
       
        $data['language'] = 'en';
        $data['fromDate'] = date('Y-m-d', strtotime(date("Y-m-d").'-15 days')); 
        $data['toDate'] = date("Y-m-d h:i:s"); 
        $url = 'http://enam.gov.in/NamWebSrv/rest/NfclWS/getUserRegisterFPOFPCCount'; 
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data),
            )
        );
        
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        
        $data_array =  json_decode($result, true); 
        
        unset($data_array['statusMsg']);
 
        foreach($data_array['listRegistrationCounterFPOFPCCommonModel'] as $res){
            
            $state_id              =  $res['stateId'];
            $state_name              =  $res['stateName'];
            $count              =  $res['count'];
            $this->db->query('UPDATE stackholder_data SET total = "$count", fpo = "$count" WHERE state_id = "$state_id"');
             print_r($this->db->last_query); die;
        }
        
        
    }


    function page_search(){
        $text = $this->input->post('text');
        $this->db->select('*');
        $this->db->like('page_name',$text);
        $result = $this->db->get_where('pages',array('status'=>1))->result_array();
       
        if(count($result)>0){
            echo json_encode(array('status'=>200,'data'=>$result));
        }
        else{
            echo json_encode(array('status'=>500));
        }
    }
	
	function stakeholder_default_data(){
		$date = $this->db->query("select DISTINCT(created_at) as created_at from stackholder_data ORDER by created_at DESC LIMIT 1")->result_array();
		$result = $this->db->query("SELECT sum(trader) as trader,sum(commsionAgent) as commsionAgent, sum(serviceProvider) as serviceProvider,sum(farmer) as farmer, sum(fpo) as fpo  , DATE_FORMAT(created_at , '%D %M %Y') as created_at  FROM `stackholder_data` where created_at = '".$date[0]['created_at']."'")->result_Array();
		if(count($result)>0){
            echo json_encode(array('status'=>200,'data'=>$result));
        }
        else{
            echo json_encode(array('status'=>500));
        }
	}


	function export_trade_details()

	{
	//	print_r($_POST);exit;
	
		$from_date = date("Y-m-d", strtotime("-7 day") );
		$to_date = date("Y-m-d", strtotime("now") );

		$condit =  "ar.created_at between '".$from_date."' and '".$to_date."'" ;
		
        $title=date('Y-m-d');
       
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('trade data');
        //set cell A1 content with some text
        
        $this->excel->getActiveSheet()->setCellValue('A1', 'Sr.No');
        $this->excel->getActiveSheet()->setCellValue('B1', 'State');
        $this->excel->getActiveSheet()->setCellValue('C1', 'APMC');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Commodity');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Min Price');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Modal Price');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Max Price');
        $this->excel->getActiveSheet()->setCellValue('H1', 'Commodity Arrivals');
        $this->excel->getActiveSheet()->setCellValue('I1', 'Commodity Traded');
        $this->excel->getActiveSheet()->setCellValue('J1', 'Unit');
        $this->excel->getActiveSheet()->setCellValue('K1', 'Date');
  
        $a='2';    
        $sr='0';
        $exportdata = $this->Enam_model->export_trade($condit);



      //  print_r($this->db->last_query());exit;
        foreach ($exportdata as $data) {  
        	$sr++;
        	if($data['r_year']=='')
        	{
        		$r_year = 'NA';
        	} else { 
        		$r_year =$data['r_year'];
        	}
        	//print_r($r_year);exit;
        	if($data['r_start_reg']==''){$r_start_reg = 'NA';} else { $r_start_reg =$data['r_start_reg'];}
        
                   
        $this->excel->getActiveSheet()->setCellValue('A'.$a, $sr);
        $this->excel->getActiveSheet()->setCellValue('B'.$a, $data['r_state']);
        $this->excel->getActiveSheet()->setCellValue('C'.$a, $data['r_apmc']);
        $this->excel->getActiveSheet()->setCellValue('D'.$a, $data['r_commodity']);
        $this->excel->getActiveSheet()->setCellValue('E'.$a, $data['r_min_price']);
        $this->excel->getActiveSheet()->setCellValue('F'.$a, $data['r_modal_price']);
        $this->excel->getActiveSheet()->setCellValue('G'.$a, $data['r_max_price']);
        $this->excel->getActiveSheet()->setCellValue('H'.$a, $data['r_commodity_arrivals']);
        $this->excel->getActiveSheet()->setCellValue('I'.$a, $data['r_commodity_traded']);
        $this->excel->getActiveSheet()->setCellValue('J'.$a, $data['r_Commodity_Uom']);
        $this->excel->getActiveSheet()->setCellValue('K'.$a, $data['r_created_at']);
      
            
            $a++;
        }

        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setSize(12);

        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('H1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('J1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('K1')->getFont()->setBold(true);

       
        //set aligment to center for that merged cell (A1 to D1)
       /* $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/
        $filename='eNAM_Trade_Data_'.$title.'.xls'; //save our workbook as this file name
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output'); 
        	
    }



	

}

