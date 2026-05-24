<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logistic_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file','captcha','exportexcel'));
		$this->load->database();
		$this->load->model(array('admin/Language_model','admin/Users_model','admin/Slider_model','admin/Widget_model','admin/News_model','Enam_model','admin/Event_model'));
		$this->load->library(array('session','substring','lang_file','excel'));
		if(!$this->session->userdata('client_language')){
			$newdata = array(
					'client_language'  => '1',
			);
		}
		else{
			$newdata = array(
					'client_language'  => $this->session->userdata('client_language'),
			);
		}
			$this->session->set_userdata($newdata);
	}

	public function exportpage()
	{

		$this->load->helper(array('url','file'));
        $this->load->library(array('session','form_validation','ion_auth','upload','lang_file','excel','pagination'));
        $this->load->database();
        $this->lang->load('admin_lang', 'english');
        if (!$this->ion_auth->logged_in()){
            redirect('admin/admin');
        }
        $data['title'] = 'Logg Page';
        $data['head'] = $this->load->view('admin/comman/head','',TRUE);
        $data['header'] = $this->load->view('admin/comman/header','',TRUE);
        $data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
        $data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
        $data['main_contant'] = $this->load->view('admin/pages/logg/export_agri_reg',$data,TRUE);
        $this->load->view('admin/comman/index',$data);
    }

	public function export()
	{
	//	print_r($_POST);exit;
		$getting_from_date=$_POST['from_date'];
		$getting_to_date=$_POST['to_date'];

		
		$from_date = date("Y-m-d", strtotime($getting_from_date) );
		$to_date = date("Y-m-d", strtotime($getting_to_date) );
		$cond = "cf.created between '".$from_date."' and '".$to_date."'";
		
        $title=date('Y-m-d');
        $this->load->library('excel');
        //activate worksheet number 1
        $this->excel->setActiveSheetIndex(0);
        //name the worksheet
        $this->excel->getActiveSheet()->setTitle('Agri-logistics Contact Details');
        //set cell A1 content with some text
        
        $this->excel->getActiveSheet()->setCellValue('A1', 'Sr.No');
        $this->excel->getActiveSheet()->setCellValue('B1', 'Name');
        $this->excel->getActiveSheet()->setCellValue('C1', 'Email');
        $this->excel->getActiveSheet()->setCellValue('D1', 'Phone');
        $this->excel->getActiveSheet()->setCellValue('E1', 'Area of specialization');
        $this->excel->getActiveSheet()->setCellValue('F1', 'Message');
        $this->excel->getActiveSheet()->setCellValue('G1', 'Date');
        

        $a='2';    
        $sr='1';
        $exportdata = $this->Enam_model->exportAgriReg($cond);
      //  print_r($this->db->last_query());exit;
        foreach ($exportdata as $data) {  
        	
        	if($data['c_phone']=='')
        	{
        		$c_phone = 'NA';
        	} else { 
        		$c_phone =$data['c_phone'];
        	}
        	//print_r($r_year);exit;
        	if($data['c_name']==''){$c_name = 'NA';} else { $c_name =$data['c_name'];}
        	if($data['c_email']==''){$c_email = 'NA';} else { $c_email =$data['c_email'];}
        	if($data['c_phone']==''){$c_phone = 'NA';} else { $c_phone =$data['c_phone'];}
        	if($data['c_area']==''){$c_area = 'NA';} else { $c_area =$data['c_area'];}
        	if($data['c_message']==''){$c_message = 'NA';} else { $c_message =$data['c_message'];}
        	if($data['c_created']==''){$c_created = 'NA';} else { $c_created =$data['c_created'];}
       

                   
        $this->excel->getActiveSheet()->setCellValue('A'.$a, $sr);
        $this->excel->getActiveSheet()->setCellValue('B'.$a, $data['c_name']);
        $this->excel->getActiveSheet()->setCellValue('C'.$a, $data['c_email']);
        $this->excel->getActiveSheet()->setCellValue('D'.$a, $c_phone);
        $this->excel->getActiveSheet()->setCellValue('E'.$a, $c_area);
        $this->excel->getActiveSheet()->setCellValue('F'.$a, $c_message);
        $this->excel->getActiveSheet()->setCellValue('G'.$a, $c_created); 
            $a++;
            $sr++;
        }

        //change the font size
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setSize(12);
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setSize(12);
       

        //make the font become bold
        $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('E1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getStyle('G1')->getFont()->setBold(true);

       
        //set aligment to center for that merged cell (A1 to D1)
       /* $this->excel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('C2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('D2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('E2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);*/
        $filename='logistics'.$title.'.xls'; //save our workbook as this file name
        ob_end_clean();
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        
        //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
        //if you want to save it as .XLSX Excel 2007 format
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($this->excel, 'Xls');  
        //force user to download the Excel file without writing it to server's HD
        $objWriter->save('php://output'); 
        	
    }

}