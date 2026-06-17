<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

	class Lang_file {
		function heading_fetch($string = 'NULL') {
			$CI = & get_instance();
			$CI->load->database();
			$l_id = (int)$CI->session->userdata('client_language');
			if ($l_id <= 0) { $l_id = 1; }
			$safe_string = $CI->db->escape_str($string);

			$result = $CI->db->query("SELECT * from heading_item WHERE heading_id = (select id from heading WHERE heading = '{$safe_string}') and language_id in (1,".$l_id.") AND status = 1")->result_array();

			if (empty($result)) {
			    return '';
			}
			if (count($result) > 1) {
			    return $result[1]['heading_item'] ?? $result[0]['heading_item'] ?? '';
			}
			return $result[0]['heading_item'] ?? '';
			
		}
function logg_report($log_data){
		    $CI = & get_instance();
		    $CI->load->database();
		    
		    $log_data['user_id'] = (int)$CI->session->userdata('user_id');
		    $log_data['created_at'] = date('y-m-d h:i:s');
 		    
		    $CI->db->insert('logg', $log_data);
 		    
		}
		
	}
?>
