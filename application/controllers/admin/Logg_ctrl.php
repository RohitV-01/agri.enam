<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logg_ctrl extends CI_Controller{
    
    
    function __construct(){
        parent :: __construct();
        $this->load->helper(array('url','file'));
        $this->load->library(array('session','form_validation','ion_auth','upload','lang_file'));
        $this->load->database();
        $this->lang->load('admin_lang', 'english');
        if (!$this->ion_auth->logged_in()){
            redirect('admin/admin');
        }
    }
    
    public function index(){
        $data['title'] = 'Logg Page';
        $data['head'] = $this->load->view('admin/comman/head','',TRUE);
        $data['header'] = $this->load->view('admin/comman/header','',TRUE);
        $data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
        $data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
        $data['main_contant'] = $this->load->view('admin/pages/logg/logg_page',$data,TRUE);
        $this->load->view('admin/comman/index',$data);
    }
    
    
    public function logg_report(){
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        
        $condition = '';
        if($from_date != ''){
            $condition.="AND cast(lg.created_at as date) >= '".date("Y-m-d",strtotime($from_date))."'";
        }
        
        if($to_date != ''){
            $condition.="AND cast(lg.created_at as date) <= '".date("Y-m-d",strtotime($to_date))."'";
        }
        
        $this->db->select('lg.activity_id,
                           u.username,
                           DATE_FORMAT(lg.created_at, "%d-%M-%Y, %h:%m:%s") as created_at,
                           ue.event_name,
                           ue.table_name,
                           ue.column_name
                        ');
        $this->db->join('users u','u.id=lg.user_id','inner');
        $this->db->join('users_events ue','ue.ue_id=lg.event_id','inner');
        $this->db->where('1=1 '.$condition);
        $this->db->order_by('l_id','DESC');
        $result = $this->db->get_where('logg lg', array('lg.status'=>1))->result_array();
     
        if(count($result) > 0 ){
            echo json_encode(array('data'=>$result, 'status'=>200));
        }else{
            echo json_encode(array('status'=>500));
        }
        
    }
    
    public function excel_download(){
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        
        $condition = '';
        if($from_date != ''){
            $condition.="AND cast(lg.created_at as date) >= '".date("Y-m-d",strtotime($from_date))."'";
        }
        
        if($to_date != ''){
            $condition.="AND cast(lg.created_at as date) <= '".date("Y-m-d",strtotime($to_date))."'";
        }
        
        $this->db->select('lg.activity_id,
                           u.username,
                           DATE_FORMAT(lg.created_at, "%d-%M-%Y, %h:%m:%s") as created_at,
                           ue.event_name,
                           ue.table_name,
                           ue.column_name
                        ');
        $this->db->join('users u','u.id=lg.user_id','inner');
        $this->db->join('users_events ue','ue.ue_id=lg.event_id','inner');
        $this->db->where('1=1 '.$condition);
        $this->db->order_by('l_id','DESC');
        $data['query'] = $this->db->get_where('logg lg', array('lg.status'=>1))->result_array();
        
        
        $phpExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $prestasi = $phpExcel->setActiveSheetIndex(0);
        
        $prestasi->setCellValue('A1', 'S. No.');
        $prestasi->setCellValue('B1', 'User Name');
        $prestasi->setCellValue('C1', 'Event Name');
        $prestasi->setCellValue('D1', 'Event Date');
        
        $no=0;
        $rowexcel = 1;
        foreach($data['query'] as $row)
        {
            $no++;
            $rowexcel++;
            $prestasi->setCellValue('A'.$rowexcel, $no);
            $prestasi->setCellValue('B'.$rowexcel, $row["username"]);
            $prestasi->setCellValue('C'.$rowexcel, $row["event_name"]);
            $prestasi->setCellValue('D'.$rowexcel, $row["created_at"]);
        }

        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($phpExcel, 'Xlsx');
       
        if(!is_dir('./logg_backup')){
            mkdir('./logg_backup');
        }
        
        $date =date('U');
        $filename = "logg_backup/logg_report_".$date.".xlsx";
        
        $objWriter->save($filename);
        $result = array(
            'file_name' => $filename,
            'file_path' =>$filename
        );
        
        echo json_encode(array('download'=>$filename));
    }
    
}