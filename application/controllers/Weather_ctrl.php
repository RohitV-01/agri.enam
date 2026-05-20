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
            $this->db->select('DISTINCT(wf_STATE_UT) as wf_STATE_UT');
						$this->db->order_by('wf_STATE_UT','ASC');
						  $this->db->where('wf_date BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW()');
               
						$result = $this->db->get('weather_forecast')->result_array();
						if(count($result)>0){
							echo json_encode(array('data'=>$result,'status'=>200));
						}
						else{
							echo json_encode(array('status'=>500));
						}
        }

        function mandi_namedetail(){
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
        }

    		function mandi_name(){
                $mandi_id = $this->input->post('mandi_id');
                $state_name= $this->input->post('state_name');
                $this->db->select('*');
								//$this->db->where('created_at',$max_date[0]['created_at']);
                $this->db->where('wf_date BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW()');
                $this->db->order_by('wf_date','DESC');
                $result = $this->db->get_where('weather_forecast',array('wf_STATE_UT'=>$state_name,'wf_APMC'=>$mandi_id))->result_array();
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

