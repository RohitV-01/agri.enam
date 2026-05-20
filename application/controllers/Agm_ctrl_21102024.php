<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agm_ctrl extends CI_Controller {

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
	
           function states_name(){
		$this->db->select('DISTINCT(AGM_ST_Code) AS AGM_ST_Code , upper(AGM_Mandi_State_Name) AS AGM_Mandi_State_Name' );

                $this->db->order_by('AGM_Mandi_State_Name','ASC');

		$result = $this->db->get_Where('agm_non_enam_mandis_2020jun')->result_array();

               if(count($result)>0){

			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
	}

         function dist_list(){
           $AGM_ST_Code = $this->input->post('AGM_ST_Code');

           $this->db->select('DISTINCT(AGM_Dist_Code) AS AGM_Dist_Code, upper(AGM_Mandi_District_Name) AS AGM_Mandi_District_Name');

           	$this->db->order_by('AGM_Mandi_District_Name','ASC');

           $result = $this->db->get_where('agm_non_enam_mandis_2020jun',array('AGM_ST_Code'=>$AGM_ST_Code))->result_array();

         if(count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
        } 

        function apmc_list(){
           $AGM_ST_Code =   $this->input->post('AGM_ST_Code');
           $AGM_Dist_Code = (int)$this->input->post('AGM_Dist_Code');
           $this->db->select('DISTINCT(AGM_Mandi_Code) AS AGM_Mandi_Code, upper(AGM_Mandi_Name) AS AGM_Mandi_Name');

           $this->db->order_by('AGM_Mandi_Name','ASC');

           $result = $this->db->get_where('agm_non_enam_mandis_2020jun',array('AGM_ST_Code' => $AGM_ST_Code, 'AGM_Dist_Code' => $AGM_Dist_Code))->result_array();

         if(count($result)>0){
			echo json_encode(array('data'=>$result,'status'=>200));
		}
		else{
			echo json_encode(array('status'=>500));
		}
        } 
  function commodity_list(){
			$stateName = $this->input->post('stateName');
			$distName = $this->input->post('districtName');
			$apmcName = $this->input->post('apmcName');
			$from_date = $this->input->post('fromDate');
			$to_date = $this->input->post('toDate');

			//print_r($_POST);exit;
			if($stateName == "-- All --"){
      $this->db->select('DISTINCT(mmpt.Agmp_Commodity) as Commodity');
      $this->db->order_by('mmpt.Agmp_Arrival_Date');

			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');

				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');

			$result = $this->db->get_where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date))->result_array();
			}

			elseif($distName == "-- Select Districts --"){
      $this->db->select('DISTINCT(mmpt.Agmp_Commodity) as Commodity');

      $this->db->order_by('mmpt.Agmp_Arrival_Date');

			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');

				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');

			$result = $this->db->get_where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_State' => $stateName,'mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date))->result_array();

			}

			elseif($apmcName == "-- Select APMCs --"){
      $this->db->select('DISTINCT(mmpt.Agmp_Commodity) as Commodity');

      $this->db->order_by('mmpt.Agmp_Arrival_Date');

			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');

				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');

			$result = $this->db->get_where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_State' => $stateName,'mandi.AGM_Mandi_District_Name'=>$distName,'mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date))->result_array();
			}

			else
			{
      $this->db->select('DISTINCT(mmpt.Agmp_Commodity) as Commodity');

      $this->db->order_by('mmpt.Agmp_Arrival_Date');

			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');

				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');

			$result = $this->db->get_where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_State' => $stateName,'mandi.AGM_Mandi_District_Name'=>$distName,'mmpt.Agmp_Non_Enam_Mandi'=>$apmcName,'mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date))->result_array();

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
			$districtName = $this->input->post('districtName');
			$apmcName = $this->input->post('apmcName');
			$commodity = $this->input->post('commodityName');
			$from_date = $this->input->post('fromDate');
			$to_date = $this->input->post('toDate');
            $result = array();    

            if ($from_date == "" || $to_date == "") 
            {
            	echo "Error; From date or To date is missing.";
            	return false;
            }

            if($stateName == "-- All --" && $districtName == "-- Select Districts --" && $apmcName == "-- Select APMCs --" && $commodity == "-- Select Commodity --"){
      $this->db->select('mmpt.Agmp_State state, mandi.AGM_Mandi_District_Name District,mmpt.Agmp_Non_Enam_Mandi mandi,mmpt.Agmp_Commodity Commodity,mmpt.Agmp_Variety variety,mmpt.Agmp_Min_Price minrate,mmpt.Agmp_Max_Price maxrate,mmpt.Agmp_Modal_Price modelprice,mmar.Agma_Arrivals arrival_qty,mmar.Agma_unit Unit,mmpt.Agmp_Arrival_Date trn_date');

      $this->db->order_by('mmpt.Agmp_Arrival_Date');

			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');

				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');

			$result = $this->db->get_where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date))->result_array();
			}
			else if($stateName != "-- All --" && $districtName == "-- Select Districts --" && $apmcName == "-- Select APMCs --" && $commodity == "-- Select Commodity --"){
				if(isset($apmcName) && $apmcName != '-- Select APMCs --'){

			$this->db->select('mmpt.Agmp_State state, mandi.AGM_Mandi_District_Name District,mmpt.Agmp_Non_Enam_Mandi mandi,mmpt.Agmp_Commodity Commodity,mmpt.Agmp_Variety variety,mmpt.Agmp_Min_Price minrate,mmpt.Agmp_Max_Price maxrate,mmpt.Agmp_Modal_Price modelprice,mmar.Agma_Arrivals arrival_qty,mmar.Agma_unit Unit,mmpt.Agmp_Arrival_Date trn_date');
      $this->db->order_by('mmpt.Agmp_Arrival_Date');
			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');
				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');
				$this->db->where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_State' => $stateName,
				'mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date));

				$this->db->where_in("(SELECT AGM_Mandi_District_Name FROM `agm_non_enam_mandis_2020jun` WHERE mandi.AGM_Mandi_State_Name = '".$stateName."' AND mandi.AGM_Mandi_Name = '".$apmcName."')");
				$result = $this->db->get('agm_non_enam_pricetrend_2020jun mmpt')->result_array();

				}
				else{

					      $this->db->select('mmpt.Agmp_State state, mandi.AGM_Mandi_District_Name District,mmpt.Agmp_Non_Enam_Mandi mandi,mmpt.Agmp_Commodity Commodity,mmpt.Agmp_Variety variety,mmpt.Agmp_Min_Price minrate,mmpt.Agmp_Max_Price maxrate,mmpt.Agmp_Modal_Price modelprice,mmar.Agma_Arrivals arrival_qty,mmar.Agma_unit Unit,mmpt.Agmp_Arrival_Date trn_date');

      $this->db->order_by('mmpt.Agmp_Arrival_Date');

			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');

				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');

			$result = $this->db->get_where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_State' => $stateName,'mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date))->result_array();

				}
			}


			else if($stateName != "-- All --" && $districtName != "-- Select Districts --" && $apmcName == "-- Select APMCs --" && $commodity == "-- Select Commodity --"){
				if(isset($apmcName) && $apmcName != '-- Select APMCs --'){

			$this->db->select('mmpt.Agmp_State state, mandi.AGM_Mandi_District_Name District,mmpt.Agmp_Non_Enam_Mandi mandi,mmpt.Agmp_Commodity Commodity,mmpt.Agmp_Variety variety,mmpt.Agmp_Min_Price minrate,mmpt.Agmp_Max_Price maxrate,mmpt.Agmp_Modal_Price modelprice,mmar.Agma_Arrivals arrival_qty,mmar.Agma_unit Unit,mmpt.Agmp_Arrival_Date trn_date');
      $this->db->order_by('mmpt.Agmp_Arrival_Date');
			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');
				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');
				$this->db->where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_State' => $stateName,
				'mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date));

				$this->db->where_in("(SELECT AGM_Mandi_District_Name FROM `agm_non_enam_mandis_2020jun` WHERE mandi.AGM_Mandi_State_Name = '".$stateName."' AND mandi.AGM_Mandi_District_Name = '".$districtName."' AND mandi.AGM_Mandi_Name = '".$apmcName."')");
				$result = $this->db->get('agm_non_enam_pricetrend_2020jun mmpt')->result_array();					

				}
				else{
		  $this->db->select('mmpt.Agmp_State state, mandi.AGM_Mandi_District_Name District,mmpt.Agmp_Non_Enam_Mandi mandi,mmpt.Agmp_Commodity Commodity,mmpt.Agmp_Variety variety,mmpt.Agmp_Min_Price minrate,mmpt.Agmp_Max_Price maxrate,mmpt.Agmp_Modal_Price modelprice,mmar.Agma_Arrivals arrival_qty,mmar.Agma_unit Unit,mmpt.Agmp_Arrival_Date trn_date');

      $this->db->order_by('mmpt.Agmp_Arrival_Date');

			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');

				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');

			$result = $this->db->get_where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_State' => $stateName,'mandi.AGM_Mandi_District_Name' => $districtName,'mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date))->result_array();

				
				}
			}

			else if($stateName != "-- All --" && $districtName != "-- Select Districts --" && $apmcName != "-- Select APMCs --" && $commodity == "-- Select Commodity --"){

							$this->db->select('mmpt.Agmp_State state, mandi.AGM_Mandi_District_Name District,mmpt.Agmp_Non_Enam_Mandi mandi,mmpt.Agmp_Commodity Commodity,mmpt.Agmp_Variety variety,mmpt.Agmp_Min_Price minrate,mmpt.Agmp_Max_Price maxrate,mmpt.Agmp_Modal_Price modelprice,mmar.Agma_Arrivals arrival_qty,mmar.Agma_unit Unit,mmpt.Agmp_Arrival_Date trn_date');
      $this->db->order_by('mmpt.Agmp_Arrival_Date');
			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');

				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');

			$result = $this->db->get_where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_State' => $stateName,'mandi.AGM_Mandi_District_Name' => $districtName,'mmpt.Agmp_Non_Enam_Mandi' => $apmcName,'mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date))->result_array();
			}
			else if($stateName != "-- All --" && $districtName != "-- Select Districts --" && $apmcName != "-- Select APMCs --" && $commodity != "-- Select Commodity --"){

			$this->db->select('mmpt.Agmp_State state, mandi.AGM_Mandi_District_Name District,mmpt.Agmp_Non_Enam_Mandi mandi,mmpt.Agmp_Commodity Commodity,mmpt.Agmp_Variety variety,mmpt.Agmp_Min_Price minrate,mmpt.Agmp_Max_Price maxrate,mmpt.Agmp_Modal_Price modelprice,mmar.Agma_Arrivals arrival_qty,mmar.Agma_unit Unit,mmpt.Agmp_Arrival_Date trn_date');
      $this->db->order_by('mmpt.Agmp_Arrival_Date');
			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');

				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');

			$result = $this->db->get_where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_State' => $stateName,'mandi.AGM_Mandi_District_Name' => $districtName,'mmpt.Agmp_Non_Enam_Mandi' => $apmcName,'mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date))->result_array();
			}

            else if($stateName != "-- All --" && $districtName == "-- Select Districts --" && $apmcName == "-- Select APMCs --" && $commodity != "-- Select Commodity --"){

      $this->db->select('mmpt.Agmp_State state, mandi.AGM_Mandi_District_Name District,mmpt.Agmp_Non_Enam_Mandi mandi,mmpt.Agmp_Commodity Commodity,mmpt.Agmp_Variety variety,mmpt.Agmp_Min_Price minrate,mmpt.Agmp_Max_Price maxrate,mmpt.Agmp_Modal_Price modelprice,mmar.Agma_Arrivals arrival_qty,mmar.Agma_unit Unit,mmpt.Agmp_Arrival_Date trn_date');
      $this->db->order_by('mmpt.Agmp_Arrival_Date');
			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');

				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');

			$result = $this->db->get_where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_State' => $stateName,'mmpt.Agmp_Commodity' => $commodity,'mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date))->result_array();


			}


            else if($stateName != "-- All --" && $districtName != "-- Select Districts --" && $apmcName == "-- Select APMCs --" && $commodity != "-- Select Commodity --"){
      $this->db->select('mmpt.Agmp_State state, mandi.AGM_Mandi_District_Name District,mmpt.Agmp_Non_Enam_Mandi mandi,mmpt.Agmp_Commodity Commodity,mmpt.Agmp_Variety variety,mmpt.Agmp_Min_Price minrate,mmpt.Agmp_Max_Price maxrate,mmpt.Agmp_Modal_Price modelprice,mmar.Agma_Arrivals arrival_qty,mmar.Agma_unit Unit,mmpt.Agmp_Arrival_Date trn_date');
      $this->db->order_by('mmpt.Agmp_Arrival_Date');
			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');

				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');

			$result = $this->db->get_where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_State' => $stateName,'mmpt.Agmp_Commodity' => $commodity,'mandi.AGM_Mandi_District_Name' => $districtName ,'mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date))->result_array();

			}
//////// written on dated 15 Jul 19 by SB
			else if($stateName = "-- All --" && $districtName == "-- Select Districts --" && $apmcName == "-- Select APMCs --" && $commodity != "-- Select Commodity --")
			{
		   $this->db->select('mmpt.Agmp_State state, mandi.AGM_Mandi_District_Name District,mmpt.Agmp_Non_Enam_Mandi mandi,mmpt.Agmp_Commodity Commodity,mmpt.Agmp_Variety variety,mmpt.Agmp_Min_Price minrate,mmpt.Agmp_Max_Price maxrate,mmpt.Agmp_Modal_Price modelprice,mmar.Agma_Arrivals arrival_qty,mmar.Agma_unit Unit,mmpt.Agmp_Arrival_Date trn_date');
      $this->db->order_by('mmpt.Agmp_Arrival_Date');
			$this->db->join('agm_non_enam_arrival_2020jun mmar','mmpt.Agmp_State = mmar.Agma_State and mmpt.Agmp_Non_Enam_Mandi = mmar.Agma_Non_Enam_Mandi and mmpt.Agmp_Commodity = mmar.Agma_Commodity and mmpt.Agmp_Arrival_Date = mmar.Agma_Arrival_date');

				$this->db->join('agm_non_enam_mandis_2020jun mandi','mmpt.Agmp_State = mandi.AGM_Mandi_State_Name and mmpt.Agmp_Non_Enam_Mandi = mandi.AGM_Mandi_Name');

			$result = $this->db->get_where('agm_non_enam_pricetrend_2020jun mmpt',array('mmpt.Agmp_Commodity' => $commodity,'mmpt.Agmp_Arrival_Date >='=>$from_date ,'mmpt.Agmp_Arrival_Date <=' => $to_date))->result_array();
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


	

}

