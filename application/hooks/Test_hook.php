<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test_hook  {

	function hooks_fun(){ 
$CI =& get_instance(); 
$ip = $CI->input->ip_address(); 
// Ensure the database is loaded before querying 
if (!isset($CI->db)) { 
$CI->load->database(); 
} 
$result = $CI->db->query("select * from visitor_count where created_at > DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 3 HOUR) AND ip = '".$ip."'")->result_array(); if(count($result) == 0){ 
$CI->db->insert('visitor_count',array('ip'=>$ip)); 
} 
}

	
}
