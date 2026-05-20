<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Liveprice_ctrl extends CI_Controller {

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

		 function states_name_live()
        {
        	$from_date = $this->input->post('fromDate');
        		$this->db->select('distinct(state)');
                $this->db->order_by('state','ASC');
		$result = $this->db->get_Where('curr_day_trade_data',array('created_at'=>$from_date,'status'=>1))->result_array();
               if(count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
        }

        function commodity_names()
        {
        	$from_date = $this->input->post('fromDate');
        		$this->db->select('distinct(commodity)');
                $this->db->order_by('commodity','ASC');
		$result = $this->db->get_Where('curr_day_trade_data',array('created_at'=>$from_date,'status'=>1))->result_array();
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
			$from_date = $this->input->post('fromDate');
            $result = array();        
            if($stateName == "-- All --"){
				/*$result = $this->db->query("select * from trade_data WHERE created_at >= '".$from_date."' AND created_at <= '".$to_date."' group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC, state ASC, apmc ASC,created_at DESC")->result_array();*/
				$sql = "SELECT DISTINCT  apmc,commodity,min_price,modal_price,max_price  from curr_day_trade_data WHERE created_at >= ? group by commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY state ASC, apmc ASC,created_at DESC";
				$result = $this->db->query($sql, array($from_date))->result_array();

			}
			else if($stateName != "-- All --"){
					/*$result = $this->db->query("select * from trade_data WHERE state = '".$stateName."' AND created_at >= '".$from_date."' AND created_at <= '".$to_date."' group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC,state ASC, apmc ASC,created_at DESC")->result_array();*/

					$sql = "SELECT * from curr_day_trade_data WHERE state = ? AND created_at >= ?  group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY state ASC, apmc ASC,created_at DESC";
				
					$result = $this->db->query($sql, array($stateName , $from_date))->result_array();

				
			}

			//print_r($result);

			if(count($result)>0){
				echo json_encode(array('data'=>$result,'status'=>200));
			}
			else{
				echo json_encode(array('status'=>500));
			}
		}


	function trade_data_list_1(){
			//print_r($_POST);exit;
			$commodity_name = $this->input->post('commodity_name');
			$from_date = $this->input->post('fromDate');
			//print_r($_POST);exit;
            $result = array();        
            if($commodity_name == "-- All --"){
				/*$result = $this->db->query("select * from trade_data WHERE created_at >= '".$from_date."' AND created_at <= '".$to_date."' group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC, state ASC, apmc ASC,created_at DESC")->result_array();*/
				$sql = "SELECT * from curr_day_trade_data WHERE created_at >= ? group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY state ASC, apmc ASC,created_at DESC";
				$result = $this->db->query($sql, array($from_date))->result_array();
			}
			else if($commodity_name != "-- All --"){
					/*$result = $this->db->query("select * from trade_data WHERE state = '".$stateName."' AND created_at >= '".$from_date."' AND created_at <= '".$to_date."' group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY commodity_traded DESC,state ASC, apmc ASC,created_at DESC")->result_array();*/
					$sql = "SELECT * from curr_day_trade_data WHERE commodity = ? AND created_at >= ?  group by state,apmc,commodity,min_price,modal_price,max_price,commodity_arrivals,commodity_traded,created_at ORDER BY state ASC, apmc ASC,created_at DESC";
					$result = $this->db->query($sql, array($commodity_name , $from_date))->result_array();
			}

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



}

