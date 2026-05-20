<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->library(array('session','form_validation','ion_auth','upload','lang_file'));
		$this->load->database();
		$this->load->model(array('admin/Language_model','admin/News_model','admin/Page_model','admin/Users_model','admin/Event_model','admin/Video_model','admin/Slider_model'));
		$this->lang->load('admin_lang', 'english');
		if (!$this->ion_auth->logged_in()){
			redirect('admin/admin');
		}
	}
	public function index(){
		$data['title'] = 'eNam Admin';
		$data['head'] = $this->load->view('admin/comman/head','',TRUE);
		$data['header'] = $this->load->view('admin/comman/header','',TRUE);
		$data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
		$data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('admin/pages/login',$data,TRUE);
		$this->load->view('admin/comman/index',$data);
	}
	
	function dashboard(){
		$data['title'] = 'eNam Admin';
		$l_id = $this->session->userdata('language'); 
		$languages = $this->Language_model->get_all_language();
		foreach($languages as $language){
			if($language['l_id'] == $l_id){
				$data['language'] = $language; 
			}
		}
		$data['videos'] = $this->Video_model->video_home_page_list();
		$data['sliders'] = $this->Slider_model->slider_list_client();
		$data['newses'] = $this->News_model->news_list_dashboard();
		$data['pages'] = $this->Page_model->get_all_pages_dashboard();
		$data['events'] = $this->Event_model->event_list_dashboard();
		$data['languages'] = $this->Language_model->get_all_language();
		$data['users'] = $result = $this->Users_model->get_all_users_dashboard();
		$data['head'] = $this->load->view('admin/comman/head','',TRUE);
		$data['header'] = $this->load->view('admin/comman/header','',TRUE);
		$data['navigation'] = $this->load->view('admin/comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('admin/pages/dashboard',$data,TRUE);
		$this->load->view('admin/comman/index',$data);
	}
	
	public function all_page()
	{
		$data['title'] = 'eNam Admin';
		$data['head'] = $this->load->view('admin/comman/head','',TRUE);
		$data['header'] = $this->load->view('admin/comman/header','',TRUE);
		$data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
		$data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('admin/pages/page/all-page',$data,TRUE);
		$this->load->view('admin/comman/index',$data);
	}
	/*public function edit_page()
	{
		$data['title'] = 'eNam Admin';
		$data['head'] = $this->load->view('admin/comman/head','',TRUE);
		$data['header'] = $this->load->view('admin/comman/header','',TRUE);
		$data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
		$data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('admin/pages/page/edit',$data,TRUE);
		$this->load->view('admin/comman/index',$data);
	}*/
	
	
	
	public function home_page()
	{
		$data['title'] = 'eNam Admin';
		$data['head'] = $this->load->view('admin/comman/head','',TRUE);
		$data['header'] = $this->load->view('admin/comman/header','',TRUE);
		$data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
		$data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('admin/pages/layout/home_page',$data,TRUE);
		$this->load->view('admin/comman/index',$data);
	}
	
	function backup(){
		// Name of the file
		$filename = 'backup.sql';
		// Use CodeIgniter database configuration
		$mysql_host = $this->db->hostname;
		$mysql_username = $this->db->username;
		$mysql_password = $this->db->password;
		$mysql_database = $this->db->database;
		$this->EXPORT_TABLES($mysql_host, $mysql_username,$mysql_password,$mysql_database);		
	}
	
	function EXPORT_TABLES($host,$user,$pass,$name,$tables=false, $backup_name=false){ 
	date_default_timezone_set("Asia/Kolkata");
		$date = date("d_m_Y_h_i_s"); 
		$filename = $date.'.sql'; 
		set_time_limit(3000);
		$mysqli = new mysqli($host,$user,$pass,$name); 
		$mysqli->select_db($name); 
		$mysqli->query("SET NAMES 'utf8'");
		$queryTables = $mysqli->query('SHOW TABLES'); 
		while($row = $queryTables->fetch_row()) { 
			$target_tables[] = $row[0]; 
		}	
		if($tables !== false) { 
			$target_tables = array_intersect( $target_tables, $tables); 
		} 
	
		$content = "SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";\r\nSET FOREIGN_KEY_CHECKS = 0;\r\nSET time_zone = \"+5:30\";\r\n\r\n\r\n/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;\r\n/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;\r\n/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;\r\n/*!40101 SET NAMES utf8 */;\r\n--\r\n-- Database: `".$name."`\r\n--\r\n\r\n\r\n";
	
		foreach($target_tables as $table){
			if (empty($table)){ continue; } 
			$result	= $mysqli->query('SELECT * FROM `'.$table.'`');  	$fields_amount=$result->field_count;  $rows_num=$mysqli->affected_rows; 	$res = $mysqli->query('SHOW CREATE TABLE '.$table);	$TableMLine=$res->fetch_row(); 
			$content .= "\n\n".$TableMLine[1].";\n\n";   $TableMLine[1]=str_ireplace('CREATE TABLE `','CREATE TABLE IF NOT EXISTS `',$TableMLine[1]);
			for ($i = 0, $st_counter = 0; $i < $fields_amount;   $i++, $st_counter=0) {
				while($row = $result->fetch_row())	{ //when started (and every after 100 command cycle):
					if ($st_counter%100 == 0 || $st_counter == 0 )	{$content .= "\nINSERT INTO ".$table." VALUES";}
						$content .= "\n(";    for($j=0; $j<$fields_amount; $j++){ $row[$j] = str_replace("\n","\\n", addslashes($row[$j]) ); if (isset($row[$j])){$content .= '"'.$row[$j].'"' ;}  else{$content .= '""';}	   if ($j<($fields_amount-1)){$content.= ',';}   }        $content .=")";
					//every after 100 command cycle [or at last line] ....p.s. but should be inserted 1 cycle eariler
					if ( (($st_counter+1)%100==0 && $st_counter!=0) || $st_counter+1==$rows_num) {$content .= ";";} else {$content .= ",";}	$st_counter=$st_counter+1;
				}
			} $content .="\n\n\n";
		}
		$content .= "\r\n\r\n/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;\r\n/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;\r\n/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;";
		$backup_name = $backup_name ? $backup_name : $name.'___('.date('H-i-s').'_'.date('d-m-Y').').sql';
		ob_get_clean(); header('Content-Type: application/octet-stream');  header("Content-Transfer-Encoding: Binary");  header('Content-Length: '. (function_exists('mb_strlen') ? mb_strlen($content, '8bit'): strlen($content)) );    header("Content-disposition: attachment; filename=\"".$backup_name."\""); 
		header('Content-Type: application/octet-stream');   
		header("Content-Transfer-Encoding: Binary"); 
		header("Content-disposition: attachment; filename=".$filename."");
		echo $content; exit;
	}
	
	
	function trade_data(){
		$data['title'] = 'eNam Admin | trade_data';
		$languages = $this->Language_model->get_all_language();
		foreach($languages as $language){
			if($language['l_id'] == $this->session->userdata('language'))
			$data['language'] = $language;
		}
		$data['head'] = $this->load->view('admin/comman/head','',TRUE);
		$data['header'] = $this->load->view('admin/comman/header','',TRUE);
		$data['navigation'] = $this->load->view('admin/comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
		$data['main_contant'] = $this->load->view('admin/pages/component/trade_data',$data,TRUE);
		$this->load->view('admin/comman/index',$data);
	}
}