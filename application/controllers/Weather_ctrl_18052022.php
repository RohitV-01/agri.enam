<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Weather_ctrl extends CI_Controller {

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

        function state_namedetail(){
           /* $this->db->select('DISTINCT(wf_STATE_UT) as wf_STATE_UT');
						$this->db->order_by('wf_STATE_UT','ASC');
						  $this->db->where('wf_date BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW()');
               
						$result = $this->db->get('weather_forecast')->result_array();
						if(count($result)>0){
							echo json_encode(array('data'=>$result,'status'=>200));
						}
						else{
							echo json_encode(array('status'=>500));
						}*/

			$this->db->select('DISTINCT(wsam_STATE_UT) as wsam_STATE_UT');
			$this->db->order_by('wsam_STATE_UT','ASC');
			$result = $this->db->get('Weather_St_Apmc_Mst')->result_array();
			if(count($result)>0){
				echo json_encode(array('data'=>$result,'status'=>200));
			}
			else{
				echo json_encode(array('status'=>500));
			}
        }

        function mandi_namedetail(){

        	$state_name = $this->input->post('state_code');          
	      	$this->db->select('distinct(wsam_Station_code), wsam__APMC');
			$this->db->group_by('wsam__APMC');
	 	 	$result = $this->db->get_where('weather_st_apmc_mst',array('wsam_STATE_UT'=>$state_name))->result_array();
	      	if(count($result)>0){
				echo json_encode(array('data'=>$result,'status'=>200));
			}
			else{
				echo json_encode(array('status'=>500));
			}




        /*
        	$state_name = $this->input->post('state_code');          
          $this->db->select('wf_APMC');
					$this->db->group_by('wf_APMC');
					  $this->db->where('wf_date BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW()');
               
          $result = $this->db->get_where('weather_forecast',array('wf_STATE_UT'=>$state_name))->result_array();
          if(count($result)>0){

					echo json_encode(array('data'=>$result,'status'=>200));
						}
						else{
							echo json_encode(array('status'=>500));
						}
        */



		}

		function mandi_name(){
            $mandi_id = $this->input->post('mandi_id');
            $state_name= $this->input->post('state_name');
            $sql = "SELECT Wfm.Wsam_Station_Code,
			       Wfm.Wsam_State_Ut,
			       Wfm.Wsam__Apmc,
			       Wfd.Wf_Max_Temp,
			       Wfd.Wf_Min_Temp,
			       Wfd.Wf_Todays_Forecast,
			       Wfd.Wf_Date
				FROM Weather_Rawdata Wfd 
				  INNER JOIN Weather_St_Apmc_Mst Wfm 
				    ON Wfd.Wf_Station_Code = Wfm.Wsam_Station_Code
				WHERE Wfm.Wsam_State_Ut = '$state_name'
				      AND Wfm.wsam__APMC = '$mandi_id'
				      AND date(Wfd.Wf_Date) = date(date_sub(now(), interval 0 day))
				ORDER BY Wfd.Wf_Date DESC
				LIMIT 1";

			$result = $this->db->query($sql)->result_array();
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
}

