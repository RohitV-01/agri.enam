<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class Excel_import extends CI_Controller
{
    function __construct(){
        parent :: __construct();
        $this->load->helper(array('url','file'));
        $this->load->library(array('session','form_validation','ion_auth','upload','lang_file','excel','pagination'));
        $this->load->database();
        $this->lang->load('admin_lang', 'english');
        if (!$this->ion_auth->logged_in()){
            redirect('admin/admin');
        }
    }

    // Compatibility shim: PHPExcel used 0-based column indices; PhpSpreadsheet uses 1-based.
    private function xlsCell($worksheet, $col, $row)
    {
        return $worksheet->getCell(Coordinate::stringFromColumnIndex($col + 1) . $row)->getValue();
    }

    function index(){
        $data['title'] = 'Logg Page';
        $data['head'] = $this->load->view('admin/comman/head','',TRUE);
        $data['header'] = $this->load->view('admin/comman/header','',TRUE);
        $data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
        $data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
        $data['main_contant'] = $this->load->view('admin/pages/logg/excel_import',$data,TRUE);
        $this->load->view('admin/comman/index',$data);
    }

    function stackholder(){
        $data['title'] = 'Logg Page';
        $data['head'] = $this->load->view('admin/comman/head','',TRUE);
        $data['header'] = $this->load->view('admin/comman/header','',TRUE);
        $data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
        $data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
        $data['main_contant'] = $this->load->view('admin/pages/logg/stackholder_import',$data,TRUE);
        $this->load->view('admin/comman/index',$data);
    }


    public function allList($rowno=0){

        // Row per page
        $rowperpage = 10;

        // Row position
        if($rowno != 0){
            $rowno = ($rowno-1) * $rowperpage;
        }
        // All records count
        $this->db->select('COUNT(*) as allcount');
        $result = $this->db->get_where('mandi_contact_details')->result_array();
        $allcount = $result[0]['allcount'];

        // Get  records
        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        $this->db->limit($rowperpage, $rowno);
        $result = $this->db->get_where('mandi_contact_details',array('status'=>1))->result_array();

        // Pagination Configuration
        $config['base_url'] = base_url().'index.php/Chalan_ctrl/chalanList';
        $config['use_page_numbers'] = TRUE;
        $config['total_rows'] = $allcount;
        $config['per_page'] = $rowperpage;
        $config['full_tag_open']        =       "<ul class='pagination'>";
        $config['full_tag_close']       =       "</ul>";
        $config['first_tag_open']       =       '<li>';
        $config['first_tag_close']      =       '</li>';
        $config['last_tag_open']        =       '<li>';
        $config['last_tag_close']       =       '</li>';
        $config['next_tag_open']        =       '<li>';
        $config['next_tag_close']       =       '</li>';
        $config['prev_tag_open']        =       '<li>';
        $config['prev_tag_close']       =       '</li>';
        $config['num_tag_open']         =       '<li>';
        $config['num_tag_close']        =       '</li>';
        $config['cur_tag_open']     =       '<li class="active"><a>';
        $config['cur_tag_close']        =       '</a></li>';

        // Initialize
        $this->pagination->initialize($config);
        // Initialize $data Array
        $data['pagination'] = $this->pagination->create_links();

        $data['result'] = $result;
        $data['row'] = $rowno;

        if(count($result) > 0){
            echo json_encode(array('result'=>$data,'status'=>200));
        }else{
            echo json_encode(array('status'=>500));
        }
    }



    function import()
    {
        if(isset($_FILES["file"]["name"]))
        {
            $path = $_FILES["file"]["tmp_name"];
            $object = IOFactory::load($path);

            foreach($object->getWorksheetIterator() as $worksheet)
            {
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();


                if($this->xlsCell($worksheet, 1, 1) == 'State'){
                    if($this->xlsCell($worksheet, 2, 1) == 'District'){
                        if($this->xlsCell($worksheet, 3, 1) == 'Mandi Name'){
                            if($this->xlsCell($worksheet, 4, 1) == 'Location/Address of APMC'){
                                if($this->xlsCell($worksheet, 5, 1) == 'Contact Details'){
                                    if($this->xlsCell($worksheet, 6, 1) == 'Commodity Details'){

                                        $cur_date =  date('Y-m-d');
                                        $this->db->select('COUNT(*)');
                                        $this->db->where('CAST(created_at AS date)=', $cur_date);
                                        $cur_result =  $this->db->get_where('mandi_contact_details',array('status'=>1))->result_array();
                                        if($cur_result > 0){

                                            $this->db->where('CAST(created_at AS date)=', $cur_date);
                                            $this->db->update('mandi_contact_details',array('status'=>0));
                                        }

                                        for($row=2; $row <= $highestRow; $row++)
                                        {
                                            $state           = $this->xlsCell($worksheet, 1, $row);
                                            $district        = $this->xlsCell($worksheet, 2, $row);
                                            $mandi_name      = $this->xlsCell($worksheet, 3, $row);
                                            $address         = $this->xlsCell($worksheet, 4, $row);
                                            $contact_details = $this->xlsCell($worksheet, 5, $row);
                                            $commodity_details = $this->xlsCell($worksheet, 6, $row);

                                                $data[] = array(
                                                    'state'  => $state,
                                                    'district'   => $district,
                                                    'mandi_name'    => $mandi_name,
                                                    'address'  => $address,
                                                    'contact_details'   => $contact_details,
                                                    'commodity_details'   => $commodity_details,
                                                    'created_by' => $this->session->userdata('user_id'),
                                                    'created_at' => date( 'Y-m-d H:i:s')
                                                );
                                            }//end of for loop

                                            $result = $this->db->insert_batch('mandi_contact_details', $data);

                                            if($result){
                                                echo json_encode(array('msg'=>'Insert Successfully','status'=>200));
                                            }else{
                                                echo json_encode(array('msg'=>'Somthing Getting Wrong','status'=>500));
                                            }

                                    }else{
                                            echo json_encode(array('msg'=>'Commodity Details Heading Not Match','status'=>500));
                                        }
                                   }else{
                                        echo json_encode(array('msg'=>'Contact Details heading Not Match','status'=>500));
                                       }
                                }else{
                                    echo json_encode(array('msg'=>'Location/Address Heading Not Match','status'=>500));
                                    }
                            }else{
                                echo json_encode(array('msg'=>'2','Mandi Name Heading Not Match'=>500));
                                }
                        }else{
                            echo json_encode(array('msg'=>'District Heading Not match','status'=>500));
                            }
                        }else{
                            echo json_encode(array('msg'=>'State Heading Not Match','status'=>500));
                        }
                    }// end of foreach loop
        }else{
            echo json_encode(array('msg'=>'File Not Exist.','status'=>500));
        }

    }// end import function

    function stackholdrs_import(){
        if(isset($_FILES["file"]["name"])){
            $path = $_FILES["file"]["tmp_name"];
            $object = IOFactory::load($path);

            foreach($object->getWorksheetIterator() as $worksheet){
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();

                if($this->xlsCell($worksheet, 0, 1) == 'State'){
                    if($this->xlsCell($worksheet, 1, 1) == 'Traders'){
                        if($this->xlsCell($worksheet, 2, 1) == 'Commission Agents (CAs)'){
                            if($this->xlsCell($worksheet, 3, 1) == 'Service Provider'){
                                if($this->xlsCell($worksheet, 4, 1) == 'FPOs'){
                                    if($this->xlsCell($worksheet, 5, 1) == 'Farmer'){
                                        $cur_date =  date('Y-m-d');
                                        $this->db->select('*');
                                        $this->db->where('CAST(created_at AS date)=', $cur_date);
                                        $cur_result =  $this->db->get_where('stackholder_data',array('status'=>1))->result_array();
                                        if(count($cur_result) > 0){
                                            $this->db->query("delete from stackholder_data where CAST(created_at as date) = '".$cur_date."'");
                                        }

                                        $this->db->select('*');
                                        $this->db->where('CAST(created_at AS date)=', $cur_date);
                                        $cur_result =  $this->db->get_where('stackholder_data',array('status'=>1))->result_array();

                                        if(count($cur_result) == 0){
                                            for($row=2; $row <= $highestRow; $row++){
                                            $state = $this->xlsCell($worksheet, 0, $row);
                                            switch($state){
                                                case 'ANDHRA PRADESH':
                                                    $state = 276;
                                                    break;
                                                case 'CHANDIGARH':
                                                    $state = 526;
                                                    break;
                                                case 'CHHATTISGARH':
                                                    $state = 100;
                                                    break;
                                                case 'GUJARAT':
                                                    $state = 22;
                                                    break;
                                                case 'HARYANA':
                                                    $state = 32;
                                                    break;
                                                case 'HIMACHAL PRADESH':
                                                    $state = 43;
                                                    break;
                                                case 'JHARKHAND':
                                                    $state = 47;
                                                    break;
                                                case 'MADHYA PRADESH':
                                                    $state = 20;
                                                    break;
                                                case 'MAHARASHTRA':
                                                    $state = 296;
                                                    break;
                                                case 'ODISHA':
                                                    $state = 384;
                                                    break;
                                                case 'PUDUCHERRY':
                                                    $state = 599;
                                                    break;
                                                case 'PUNJAB':
                                                    $state = 602;
                                                    break;
                                                case 'RAJASTHAN':
                                                    $state = 26;
                                                    break;
                                                case 'TAMIL NADU':
                                                    $state = 509;
                                                    break;
                                                case 'TELANGANA':
                                                    $state = 28;
                                                    break;
                                                case 'UTTAR PRADESH':
                                                    $state = 46;
                                                    break;
                                                case 'UTTARAKHAND':
                                                    $state = 385;
                                                    break;
                                                case 'WEST BENGAL':
                                                    $state = 569;
                                                    break;
                                                case 'KERALA':
                                                    $state = 694;
                                                    break;
                                                case 'KARNATAKA':
                                                    $state = 695;
                                                    break;
                                                case 'JAMMU AND KASHMIR':
                                                    $state = 696;
                                                    break;
                                            }
                                            $trader         = $this->xlsCell($worksheet, 1, $row);
                                            $commsionAgent  = $this->xlsCell($worksheet, 2, $row);
                                            $serviceProvider= $this->xlsCell($worksheet, 3, $row);
                                            $fpo            = $this->xlsCell($worksheet, 4, $row);
                                            $farmer         = $this->xlsCell($worksheet, 5, $row);

                                                $data[] = array(
                                                    'state_id'  => $state,
                                                    'trader'   => $trader,
                                                    'commsionAgent'    => $commsionAgent,
                                                    'serviceProvider'  => $serviceProvider,
                                                    'farmer'   => $farmer,
                                                    'fpo'   => $fpo,
                                                    'total' => (int)((int)$trader + (int)$commsionAgent + (int)$serviceProvider + (int)$farmer + (int)$fpo),
                                                    'created_at' => date( 'Y-m-d H:i:s')
                                                );
                                            }//end of for loop
                                        }

                                            $result = $this->db->insert_batch('stackholder_data', $data);

                                            if($result){
                                                echo json_encode(array('msg'=>'Insert Successfully','status'=>200));
                                            }else{
                                                echo json_encode(array('msg'=>'Somthing Getting Wrong','status'=>500));
                                            }

                                    }else{
                                            echo json_encode(array('msg'=>'Commodity Details Heading Not Match','status'=>500));
                                        }
                                   }else{
                                        echo json_encode(array('msg'=>'Contact Details heading Not Match','status'=>500));
                                       }
                                }else{
                                    echo json_encode(array('msg'=>'Location/Address Heading Not Match','status'=>500));
                                    }
                            }else{
                                echo json_encode(array('msg'=>'2','Mandi Name Heading Not Match'=>500));
                                }
                        }else{
                            echo json_encode(array('msg'=>'District Heading Not match2','status'=>500));
                            }
                        }else{
                            echo json_encode(array('msg'=>'State Heading Not Match','status'=>500));
                        }
                    }// end of foreach loop
        }else{
            echo json_encode(array('msg'=>'File Not Exist.','status'=>500));
        }

    }


    function unified_licencce(){
        $data['title'] = 'Unified Licence Import';
        $data['head'] = $this->load->view('admin/comman/head','',TRUE);
        $data['header'] = $this->load->view('admin/comman/header','',TRUE);
        $data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
        $data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
        $data['main_contant'] = $this->load->view('admin/pages/logg/no_unified_licence',$data,TRUE);
        $this->load->view('admin/comman/index',$data);

    }


    function unified_licencce_import(){

        if(isset($_FILES["file"]["name"])){
            $path = $_FILES["file"]["tmp_name"];
            $object = IOFactory::load($path);

            foreach($object->getWorksheetIterator() as $worksheet){
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();

                if($this->xlsCell($worksheet, 0, 1) == 'Name of State/UT'){
                    if($this->xlsCell($worksheet, 1, 1) == 'Mandis registered on e-NAM'){
                        if($this->xlsCell($worksheet, 2, 1) == 'Registered Traders on e-NAM'){
                            if($this->xlsCell($worksheet, 3, 1) == 'No. of Unified licenses issued by State'){
                                        $cur_date =  date('Y-m-d');
                                        $this->db->select('*');
                                        $this->db->where('CAST(created_at AS date)=', $cur_date);
                                        $cur_result =  $this->db->get_where('no_unified_licence',array('status'=>1))->result_array();
                                        if(count($cur_result) > 0){
                                            $this->db->query("delete from no_unified_licence where CAST(created_at as date) = '".$cur_date."'");
                                        }

                                        $this->db->select('*');
                                        $this->db->where('CAST(created_at AS date)=', $cur_date);
                                        $cur_result =  $this->db->get_where('no_unified_licence',array('status'=>1))->result_array();

                                        if(count($cur_result) == 0){
                                            for($row=2; $row <= $highestRow; $row++){
                                                $name_of_state    = $this->xlsCell($worksheet, 0, $row);
                                                $mandis_registered= $this->xlsCell($worksheet, 1, $row);
                                                $registered_traders=$this->xlsCell($worksheet, 2, $row);
                                                $licenses_issued  = $this->xlsCell($worksheet, 3, $row);

                                                $data[] = array(
                                                        'name_state'  => $name_of_state,
                                                        'mandis_registered'   => $mandis_registered,
                                                        'registered_traders'    => $registered_traders,
                                                        'unified_licence'  => $licenses_issued,
                                                        'created_at' => date( 'Y-m-d H:i:s')
                                                );
                                            }//end of for loop
                                        }

                                        $result = $this->db->insert_batch('no_unified_licence', $data);
                                        if($result){
                                            echo json_encode(array('msg'=>'Insert Successfully','status'=>200));
                                            die;
                                        }else{
                                            echo json_encode(array('msg'=>'Somthing Getting Wrong','status'=>500));
                                            die;
                                        }

                                    }else{
                                        echo json_encode(array('msg'=>'Unified Licence Not Match','status'=>500));
                                    }
                                }else{
                                    echo json_encode(array('msg'=>'Registered Traders Not Match','status'=>500));
                                }
                            }else{
                                echo json_encode(array('msg'=>'Mandis Registered Not Match','status'=>500));
                            }
                        }else{
                            echo json_encode(array('msg'=>'2','Name Of State Not Match'=>500));
                        }

            }// end of foreach loop
        }else{
            echo json_encode(array('msg'=>'File Not Exist.','status'=>500));
        }


    }


    function weather_forecast(){
        $data['title'] = 'Logg Page';
        $data['head'] = $this->load->view('admin/comman/head','',TRUE);
        $data['header'] = $this->load->view('admin/comman/header','',TRUE);
        $data['navigation'] = $this->load->view('admin/comman/navigation','',TRUE);
        $data['footer'] = $this->load->view('admin/comman/footer','',TRUE);
        $data['main_contant'] = $this->load->view('admin/pages/logg/weather_import',$data,TRUE);
        $this->load->view('admin/comman/index',$data);
    }

     function weather_forecast_import(){
        if(isset($_FILES["file"]["name"])){
            $path = $_FILES["file"]["tmp_name"];
            $object = IOFactory::load($path);
            foreach($object->getWorksheetIterator() as $worksheet){
                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();
              if($this->xlsCell($worksheet, 0, 1) == 'Station_Code'){
                if($this->xlsCell($worksheet, 1, 1) == 'STATE / UT'){
                  if($this->xlsCell($worksheet, 2, 1) == 'eNAM APMC'){
                    if($this->xlsCell($worksheet, 3, 1) == 'Max Temp'){
                        if($this->xlsCell($worksheet, 4, 1) == 'Min temp'){
                            if($this->xlsCell($worksheet, 5, 1) == 'Todays Forecast'){
                                        $cur_date =  date('Y-m-d');
                                        $this->db->select('*');
                                        $this->db->where('CAST(wf_date AS date)=', $cur_date);
                                        $cur_result =  $this->db->get_where('weather_forecast',array('status'=>1))->result_array();
                                        if(count($cur_result) > 0){
                                            $this->db->query("delete from weather_forecast where CAST(wf_date as date) = '".$cur_date."'");
                                        }

                                        $this->db->select('*');
                                        $this->db->where('CAST(wf_date AS date)=', $cur_date);
                                        $cur_result =  $this->db->get_where('weather_forecast',array('status'=>1))->result_array();

                                        if(count($cur_result) == 0){
                                            for($row=2; $row <= $highestRow; $row++){
                                            $station_code    = $this->xlsCell($worksheet, 0, $row);
                                            $name_of_state   = $this->xlsCell($worksheet, 1, $row);
                                            $name_of_apmc    = $this->xlsCell($worksheet, 2, $row);
                                            $max_temo        = $this->xlsCell($worksheet, 3, $row);
                                            $min_temp        = $this->xlsCell($worksheet, 4, $row);
                                            $today_forecast  = $this->xlsCell($worksheet, 5, $row);

                                                $data[] = array(
                                                        'wf_Station_code'  => $station_code,
                                                        'wf_STATE_UT'  => $name_of_state,
                                                        'wf_APMC'  => $name_of_apmc,
                                                        'wf_Max_Temp'   => $max_temo,
                                                        'wf_Min_temp'    => $min_temp,
                                                        'wf_Todays_Forecast'  => $today_forecast,
                                                        'wf_date' => date( 'Y-m-d H:i:s')
                                                );
                                            }//end of for loop
                                        }

                                        $result = $this->db->insert_batch('weather_forecast', $data);
                                        if($result){
                                            echo json_encode(array('msg'=>'Insert Successfully','status'=>200));
                                            die;
                                        }else{
                                            echo json_encode(array('msg'=>'Somthing Getting Wrong','status'=>500));
                                            die;
                                        }

                                    }else{
                                        echo json_encode(array('msg'=>'Today Forecast Not Match','status'=>500));
                                    }
                                }else{
                                    echo json_encode(array('msg'=>'Min temparature Not Match','status'=>500));
                                }
                            }else{
                                echo json_encode(array('msg'=>'Max temparature Not Match','status'=>500));
                            }
                        }else{
                            echo json_encode(array('msg'=>'2','Name Of APMC Not Match'=>500));
                        }
                      }else{
                     echo json_encode(array('msg'=>'2','Name Of State Not Match'=>500));
                    }
                   }else{
                     echo json_encode(array('msg'=>'2','Station Code Not Match'=>500));
                }
            }// end of foreach loop
        }else{
            echo json_encode(array('msg'=>'File Not Exist.','status'=>500));
        }
    }


}//end of class
