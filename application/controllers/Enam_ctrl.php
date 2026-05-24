<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Enam_ctrl extends CI_Controller {

	function __construct(){

		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->database();
		$this->load->model(array('admin/Language_model','admin/Video_model','admin/Slider_model','admin/Widget_model','admin/Menu_model','Enam_model','admin/Event_model'));
		$this->load->library(array('session','substring','lang_file'));
		if(!$this->session->userdata('client_language')){
		    $newdata = array(
		        'client_language'  => '1'
		    );
		}
		else{
		    $newdata = array(
		        'client_language'  => $this->session->userdata('client_language'),
		    );
		}	
		$this->session->set_userdata($newdata);
	}

	public function index(){
	    $data = array();
        $data['page_id'] = 'page_0';
		$data['title'] = 'eNam | Home';
		$data['keywords'] = 'enam home';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		
		$data['languages'] = $this->Language_model->get_all_language();
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['marqueeSection'] = $this->load->view('pages/comman/marqueeSection','',TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
		$data['sliders'] = $this->Slider_model->slider_list_client();
		//print_r($data['sliders']); die;
		$data['videos'] = $this->Video_model->video_home_page_list();
		
		$v = array();
		foreach($data['videos'] as $ve){
			$temp = array();
			$temp = $ve;
			$temp['created_at'] = $this->time_elapsed_string(strtotime($ve['created_at']));
			$v[] = $temp;
		}
		
		$data['videos'] = $v;
		$data['home_body'] = $this->Widget_model->home_content(); 	
		$data['newses'] = $this->Enam_model->all_news();
		$data['events'] = $this->Event_model->home_list_events();
		$data['links'] = $this->Enam_model->all_links();
		$data['quickLinks'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
		
        $data['slider'] = $this->load->view('pages/comman/slider',$data,TRUE);
		$data['links'] = $this->Enam_model->all_links();
		$data['main_contant'] = $this->load->view('pages/dashboard',$data,TRUE);
		$this->load->view('comman/index',$data);
	}
	
	function time_elapsed_string($time) {
		  $time_difference = time() - $time;
		  if( $time_difference < 1 ) {
		      return 'less than 1 second ago';
		  }
	      $condition = array( 12 * 30 * 24 * 60 * 60 =>  'year',
    	  30 * 24 * 60 * 60       =>  'month',
    	  24 * 60 * 60            =>  'day',
    	  60 * 60                 =>  'hour',
    	  60                      =>  'minute',
    	  1                       =>  'second'
		);
		
		foreach( $condition as $secs => $str )
		{
			$d = $time_difference / $secs;
			if( $d >= 1 )
			{
				$t = round( $d );
				return 'about ' . $t . ' ' . $str . ( $t > 1 ? 's' : '' ) . ' ago';
			}
		}
	}

    function ip(){  
      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
      } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
        $ip = $_SERVER['REMOTE_ADDR'];
      }
      $json = file_get_contents("http://ipinfo.io/".$ip."/geo");
      $details = json_decode($json, true);
      print_r($details);
   }

    function enam_registration(){   
      $data = array();
      $data['title'] = 'eNAM | Registration';
      $data['page_id'] = '-91';
	  $data['keywords'] = 'eNAM Registration';
	  $data['head'] = $this->load->view('comman/head',$data,TRUE);
	  $data['languages'] = $this->Language_model->get_all_language();
	  $data['header'] = $this->load->view('comman/header',$data,TRUE);
	  $data['menus'] = $this->Enam_model->all_menus();
	  $data['head'] = $this->load->view('comman/head',$data,TRUE);
	  $data['header'] = $this->load->view('comman/header',$data,TRUE);
	  $data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
	  $data['footer'] = $this->load->view('comman/footer','',TRUE);
	  $data['main_contant'] = $this->load->view('pages/enam_registration/registration',$data,TRUE);
	  $this->load->view('comman/index',$data);
    }


     function datapage(){   
      $data = array();
      $data['title'] = 'eNAM | Registration';
      $data['page_id'] = '-91';
	  $data['keywords'] = 'eNAM Registration';
	  $data['head'] = $this->load->view('comman/head',$data,TRUE);
	  $data['languages'] = $this->Language_model->get_all_language();
	  $data['header'] = $this->load->view('comman/header',$data,TRUE);
	  $data['menus'] = $this->Enam_model->all_menus();
	  $data['head'] = $this->load->view('comman/head',$data,TRUE);
	  $data['header'] = $this->load->view('comman/header',$data,TRUE);
	  $data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
	  $data['footer'] = $this->load->view('comman/footer','',TRUE);
	  $data['main_contant'] = $this->load->view('pages/DARPAN/kpi_dash_data_push/push_data_to_kpi',$data,TRUE);
	  $this->load->view('comman/index',$data);
    }



	function all_news_desc(){  
	    $data = array();
		$data['page_id'] = 'page_11';
		$data['title'] = 'eNAM | News Archive';
		$data['keywords'] = 'eNAM All News Archive';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['languages'] = $this->Language_model->get_all_language();
		$this->db->select('n.*,ni.*');
		$this->db->join('news n','n.id = ni.news_id');
		$this->db->order_by('n.created_at','desc');
		$data['news_lists'] = $this->db->get_where('news_item ni',array('ni.lang_id'=>$this->session->userdata('client_language'),'n.status'=>1,'ni.status'=>1))->result_array();

                $temp = array();
		foreach($data['news_lists'] as $news) {
			$a = $news;
			$str = html_entity_decode($news['news_contect']);
			
			$regex = "/\[(.*?)\]/";
			$data['output'] = $str;
			preg_match_all($regex, $str, $matches);
			for($i =0; $i < count($matches[1]); $i++){
				$a['news_contect'] = str_replace($matches[0][$i],$this->substring->image_path(),$news['news_contect']);
			}
			$temp[] = $a;
		}
		$data['news_lists'] = $temp;

		$data['newses'] = $this->Enam_model->all_news();
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE); 
		$data['sliders'] = $this->Slider_model->slider_list_client();
		$data['links'] = $this->Enam_model->all_links();
		$data['quickLinks'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
		$data['slider'] = $this->load->view('pages/comman/slider',$data,TRUE);
		$data['main_contant'] = $this->load->view('pages/news/all_news',$data,TRUE);
		$this->load->view('comman/index',$data);
	}

   	function registration_guideline(){ 
   	    $data = array();
        $data['page_id'] = 'page_-58';
		$data['title'] = 'eNAM | Registration Guidelines';
		$data['keywords'] = 'eNAM emandi contact';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['languages'] = $this->Language_model->get_all_language();	
		$this->db->select('n.*,ni.*');
		$this->db->join('news n','n.id = ni.news_id');
		$this->db->order_by('n.created_at','desc');
		$data['newses'] = $this->db->get_where('news_item ni',array('ni.lang_id'=>$this->session->userdata('client_language'),'n.status'=>1,'ni.status'=>1))->result_array();
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();		
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
        $data['sliders'] = $this->Slider_model->slider_list_client();
        $data['links'] = $this->Enam_model->all_links();
		$data['quickLinks'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
		$data['slider'] = $this->load->view('pages/comman/slider',$data,TRUE);
		$data['main_contant'] = $this->load->view('pages/today/registration_guideline_toggle',$data,TRUE);
		$this->load->view('comman/index',$data);
    }

    function training_manuals(){ 
        $data = array();
        $data['page_id'] = 'page_-59';
		$data['title'] = 'eNAM | Manuals';
		$data['keywords'] = 'eNAM emandi contact';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);	
		$data['languages'] = $this->Language_model->get_all_language();
		$this->db->select('n.*,ni.*');
		$this->db->join('news n','n.id = ni.news_id');
		$this->db->order_by('n.created_at','desc');
		$data['newses'] = $this->db->get_where('news_item ni',array('ni.lang_id'=>$this->session->userdata('client_language'),'n.status'=>1,'ni.status'=>1))->result_array();
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
        $data['search_subscribe'] = $this->load->view('comman/home_search',$data,TRUE);
        $data['sliders'] = $this->Slider_model->slider_list_client();
        $data['links'] = $this->Enam_model->all_links();
		$data['quickLinks'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
		$data['slider'] = $this->load->view('pages/comman/slider',$data,TRUE);
		$data['main_contant'] = $this->load->view('pages/today/training_manuals_toggle',$data,TRUE);
		$this->load->view('comman/index',$data);
    }
 

	function stake_holder_module(){
	    $data = array();
        $data['page_id'] = 'page_-63';
		$data['title'] = 'eNAM | Stake Holder Module';
		$data['keywords'] = 'eNAM emandi contact';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['languages'] = $this->Language_model->get_all_language();
		$this->db->select('n.*,ni.*');
		$this->db->join('news n','n.id = ni.news_id');
		$this->db->order_by('n.created_at','desc');
		$data['newses'] = $this->db->get_where('news_item ni',array('ni.lang_id'=>$this->session->userdata('client_language'),'n.status'=>1,'ni.status'=>1))->result_array();
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();	
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);       
		$data['sliders'] = $this->Slider_model->slider_list_client();
		$data['links'] = $this->Enam_model->all_links();
		$data['quickLinks'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
		$data['slider'] = $this->load->view('pages/comman/slider',$data,TRUE);
		$data['main_contant'] = $this->load->view('pages/today/stake_holder_module',$data,TRUE);
		$this->load->view('comman/index',$data);
	}
	
//working
function mandi_contact(){
        $data = array();
        $data['page_id'] = 'page_-46';
		$data['title'] = 'eNAM | eNam Mandis';
		$data['keywords'] = 'eNAM emandi contact';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['languages'] = $this->Language_model->get_all_language();
		
		$this->db->select('n.*,ni.*');
		$this->db->join('news n','n.id = ni.news_id');
		$this->db->order_by('n.created_at','desc');
		$data['newses'] = $this->db->get_where('news_item ni',array('ni.lang_id'=>$this->session->userdata('client_language'),'n.status'=>1,'ni.status'=>1))->result_array();
	
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
		$data['search_subscribe'] = $this->load->view('comman/home_search',$data,TRUE);
		
		$data['sliders'] = $this->Slider_model->slider_list_client();
		$data['links'] = $this->Enam_model->all_links();
		$data['quickLinks'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
		$data['slider'] = $this->load->view('pages/comman/slider',$data,TRUE);

		$data['main_contant'] = $this->load->view('pages/emandi/mandi_contact',$data,TRUE);
		$this->load->view('comman/index',$data);
	}
//working
function weather_forecast(){
        $data = array();
        $data['page_id'] = 'page_-46';
		$data['title'] = 'eNAM | Weather Forecast';
		$data['keywords'] = 'eNAM Weather Forecast';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['languages'] = $this->Language_model->get_all_language();
		
		$this->db->select('n.*,ni.*');
		$this->db->join('news n','n.id = ni.news_id');
		$this->db->order_by('n.created_at','desc');
		$data['newses'] = $this->db->get_where('news_item ni',array('ni.lang_id'=>$this->session->userdata('client_language'),'n.status'=>1,'ni.status'=>1))->result_array();
	
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
		$data['search_subscribe'] = $this->load->view('comman/home_search',$data,TRUE);
		
		$data['sliders'] = $this->Slider_model->slider_list_client();
		$data['links'] = $this->Enam_model->all_links();
		$data['quickLinks'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
		$data['slider'] = $this->load->view('pages/comman/slider',$data,TRUE);

		$data['main_contant'] = $this->load->view('pages/emandi/weather_forecast',$data,TRUE);
		$this->load->view('comman/index',$data);
	}


//working
function mandi_trading(){
        $data = array();
        $data['page_id'] = 'page_-46';
		$data['title'] = 'eNAM | Trading Details';
		$data['keywords'] = 'eNAM emandi contact';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['languages'] = $this->Language_model->get_all_language();
		
	
		$this->db->select('n.*,ni.*');
		$this->db->join('news n','n.id = ni.news_id');
		$this->db->order_by('n.created_at','desc');
		$data['newses'] = $this->db->get_where('news_item ni',array('ni.lang_id'=>$this->session->userdata('client_language'),'n.status'=>1,'ni.status'=>1))->result_array();
	
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
                $data['search_subscribe'] = $this->load->view('comman/home_search',$data,TRUE);
                
                $data['sliders'] = $this->Slider_model->slider_list_client();
                $data['links'] = $this->Enam_model->all_links();
		$data['quickLinks'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
		$data['slider'] = $this->load->view('pages/comman/slider',$data,TRUE);

		$data['main_contant'] = $this->load->view('pages/emandi/trading',$data,TRUE);
		$this->load->view('comman/index',$data);
	}

function stakeholderdata(){
        $data = array();
        $data['page_id'] = 'page_-50';
		$data['title'] = 'eNAM | Stakeholder Data';
		$data['keywords'] = 'eNAM emandi contact';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
	
	    $data['languages'] = $this->Language_model->get_all_language();

		$this->db->select('n.*,ni.*');
		$this->db->join('news n','n.id = ni.news_id');
		$this->db->order_by('n.created_at','desc');
		$data['newses'] = $this->db->get_where('news_item ni',array('ni.lang_id'=>$this->session->userdata('client_language'),'n.status'=>1,'ni.status'=>1))->result_array();
		//print_r($data['news']);
	
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['menus'] = $this->Enam_model->all_menus();
		
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['header'] = $this->load->view('comman/header',$data,TRUE);
		$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
		$data['footer'] = $this->load->view('comman/footer','',TRUE);
        $data['search_subscribe'] = $this->load->view('comman/home_search',$data,TRUE);
                
        $data['sliders'] = $this->Slider_model->slider_list_client();
        $data['links'] = $this->Enam_model->all_links();
		$data['quickLinks'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
		$data['slider'] = $this->load->view('pages/comman/slider',$data,TRUE);

		$data['main_contant'] = $this->load->view('pages/stack_holder/stakeholderdata',$data,TRUE);
		$this->load->view('comman/index',$data);
	}
	
	/// download commodity pdf list
	function commodity_download()
	{
	    $data = array();
	    $l_id = $this->session->userdata('client_language');
		$data['commodity'] = $this->db->query("SELECT ci.c_id,ci.commodity_name,cc.cg_name FROM commodities_item ci
		join commodity c on c.c_id = ci.com_id
		join commodity_category cc on cc.c_id = c.g_id 
		WHERE ci.lang_id = ".$l_id." and ci.status = 1 and c.status = 1
		order by c.g_id,ci.commodity_name")->result_array();
		$data['page_id'] = '800';

	    $pdf = new Dompdf\Dompdf();
	    $html = $this->load->view('pages/pdf/commodity_pfd',$data,TRUE);
	    $pdf->loadHtml($html);
		//$pdf->setPaper('A4','portrait');
		$pdf->setPaper('A4','landscape');
	    $pdf->render();
	    $pdf->stream('commodity_list',array('Attachment'=>1));
	}

	///view the commodity pdf version
	function pdf()
	{
	    $data = array();
		$l_id = $this->session->userdata('client_language');
		$data['commodity'] = $this->db->query("SELECT ci.c_id,ci.commodity_name,cc.cg_name FROM commodities_item ci
		join commodity c on c.c_id = ci.com_id
		join commodity_category cc on cc.c_id = c.g_id 
		WHERE ci.lang_id = ".$l_id." and ci.status = 1 and c.status = 1
		order by c.g_id,ci.commodity_name")->result_array();
		$data['page_id'] = '800';
		//$data['head'] = $this->load->view('comman/head',$data,TRUE);
		//$data['home_body'] = $this->Widget_model->home_content(); 	
		$this->load->view('pages/pdf/commodity_pfd',$data);
		//$this->load->view('comman/index',$data);
	}
	
	/// download commodity pdf list
	function commodity_parameter_download(){
	    $data = array();
	    $l_id = $this->session->userdata('client_language');
	    $data['commodity'] = $this->db->query("SELECT cp.*,c.image as comm_image,cc.cg_name from commodity c 
                join commodity_parameters cp on cp.comm_id = c.c_id
                join commodity_category cc on cc.c_id = c.g_id
                WHERE cp.status = 1
                and c.status = 1
                AND cp.lang_id = 1
                and c.c_id = 118
                order by c.g_id,cp.comm_name")->result_array();
	    
	    //$this->load->view('pages/pdf/commodity_parameter_pfd',$data);
// 	    
	    $data['page_id'] = '800';
	    $pdf = new Dompdf\Dompdf();
	    $html = $this->load->view('pages/pdf/commodity_parameter_pfd',$data,TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4','portrait');
	    $pdf->render();
	    $pdf->stream('commodity_list',array('Attachment'=>0));
	}
	function login_redirect(){
		redirect('https://beta.enam.gov.in/');
	}
	function registration_redirect(){
		redirect('https://beta.enam.gov.in/');
	}
}
