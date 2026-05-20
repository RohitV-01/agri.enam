<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Url_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file'));
		$this->load->database();
		$this->load->model(array('admin/Language_model','admin/Users_model','admin/Slider_model','admin/Widget_model','admin/News_model','Enam_model','admin/Event_model'));
		$this->load->library(array('session','substring','lang_file'));
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
	
	function index(){
		if($this->session->userdata('client_language') == ''){
			$client_laguage = 1;
		}
		else{
			$client_laguage = $this->session->userdata('client_language');
		}
		$c = 1;
		$url_array ='';
		while($this->uri->segment($c) != ''){
			$url_array.= $this->uri->segment($c).'/'; 
			$c = $c + 1;	
		}
		$url_array = strtolower(rtrim($url_array,"/ "));
		$this->db->select('m.page_id,p.type');
		$this->db->join('pages p','p.p_id = m.page_id');
		$this->db->limit('1');
		$result = $this->db->get_Where('menu m',array('m.cms_url'=>$url_array,'m.status'=>1,'p.status'=>1,'p.publish'=>1,'m.external_link'=>0))->result_array();
		
		if(count($result)>0){
			$this->db->select('*');
			$page_body = $this->db->get_Where('page_item',array('page_id'=>$result[0]['page_id'],'lang_id'=>(int)$client_laguage,'status'=>1))->result_array();
			
			if(!count($page_body) > 0){
				$this->db->select('*');
				$page_body = $this->db->get_Where('page_item',array('page_id'=>$result[0]['page_id'],'lang_id'=>1,'status'=>1))->result_array();
			}
			if($result[0]['type'] == 'que_ans'){
				$this->db->select('*,qai.question,qai.ans');
				$this->db->join('question_ans qa','qa.q_id = qai.qa_id');
                                $this->db->order_by('qa.q_sort','ASC');
				$page_body['questions'] = $this->db->get_where('question_ans_item qai',array('qa.page_id'=>$result[0]['page_id'],'qai.lang_id'=>(int)$client_laguage,'qai.status'=>1))->result_array();	
				
				if(!count($page_body['questions'])>0){
					$this->db->select('*,qai.question,qai.ans');
					$this->db->join('question_ans qa','qa.q_id = qai.qa_id');
                                        $this->db->order_by('qa.q_sort','ASC');
					$page_body['questions'] = $this->db->get_where('question_ans_item qai',array('qa.page_id'=>$result[0]['page_id'],'qai.lang_id'=>1,'qai.status'=>1))->result_array();	
				}
				
				$questions = array();
					foreach($page_body['questions'] as $key => $value){
					    $str = html_entity_decode($value['ans']);
					    $regex = "/\[(.*?)\]/";
					    $data['output'] = $str;
					    preg_match_all($regex, $str, $matches);
					    
					    for($i =0; $i < count($matches[1]); $i++){
					        $match = $matches[1][$i];
					        $x = explode(':',$match);
					        if($x[1] == 'krimtel'){
					            $data['output'] = str_replace($matches[0][$i],$this->page_render($x[2]),$data['output']);
					        }
					        else if($x[1] == 'imagepath'){
					            $data['output'] =str_replace($matches[0][$i],$this->image_path($x[1]),$data['output']);
					        }
					        else {
					            $data['output'] = str_replace($matches[0][$i],$this->component_render($x[2]),$data['output']);
					        }
					    }
					    $value['ans'] = $data['output'];
					    $questions[] = $value;
					}
					$page_body['questions'] = $questions;	
			}
			
			if(empty($page_body)){
				$data['title'] = 'eNam';
				$data['keywords'] = 'enam home';
				$data['head'] = $this->load->view('comman/head',$data,TRUE);
					
			     $data['languages'] = $this->Language_model->get_all_language();
					
				$data['header'] = $this->load->view('comman/header',$data,TRUE);
				$data['menus'] = $this->Enam_model->all_menus();
				$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
					
				$data['footer'] = $this->load->view('comman/footer','',TRUE);
				$data['page_id'] = '404';
				$data['main_contant'] = $this->load->view('error',$data,TRUE);
				$this->load->view('comman/index',$data);
			}
			else { 
				$this->db->select('p.page_name,p.page_layout,pc.section,w.name,wi.content,pc.widget_id');
				$this->db->join('page_components pc','(pc.page_id = p.p_id AND pc.status = 1)');
				$this->db->join('widgets w','(w.w_id = pc.widget_id AND w.status = 1)','left');
				$this->db->join('widget_item wi','(wi.widget_id = w.w_id AND wi.status = 1 AND wi.lang_id = '.(int)$client_laguage.')','left');
				$page_component = $this->db->get_where('pages p',array(
						'p.p_id'=>(int)$result[0]['page_id'],
						'p.status' => 1					
				))->result_array();
				
				if(count($page_component)>0){
					$i = 1;
					foreach ($page_component as $pc){
						$page_body[0]['col'][$i] = $pc;
						$i++;
					}
				}
				
				$this->db->select('*');
				$page_detail = $this->db->get_where('pages',array('p_id'=>(int)$result[0]['page_id'],'publish'=>1,'status'=>1))->result_array();
				$page_body[0]['page_layout'] = $page_detail[0]['page_layout'];
				
				$data['page_contents'] = $page_body;
				if(count($data['page_contents']) > 0){	
					////////////////////////////////////
					$str = html_entity_decode($data['page_contents'][0]['page_body']);
	
	
					$regex = "/\[(.*?)\]/";
					$data['output'] = $str;
					preg_match_all($regex, $str, $matches);
					for($i =0; $i < count($matches[1]); $i++){
						$match = $matches[1][$i];
						$x = explode(':',$match);
						if(count($x)>1){
						    if($x[1] == 'krimtel'){
						        $data['output'] = str_replace($matches[0][$i],$this->page_render($x[2]),$data['output']);
						    }
						    else if($x[1] == 'imagepath'){
						        $data['output'] =str_replace($matches[0][$i],$this->image_path($x[1]),$data['output']);
						    }
						    else if($x[1] == 'comm_list'){
						        $data['output'] =str_replace($matches[0][$i],$this->comm_list($x[1]),$data['output']);
						    }
						    else if($x[1] == 'comm_param_list'){
						        $data['output'] =str_replace($matches[0][$i],$this->comm_param_list($x[1]),$data['output']);
						    }
						    else if($x[1] == 'comm_category_count'){
						        $data['output'] =str_replace($matches[0][$i],$this->comm_category_count($x[1]),$data['output']);
						    }
						    else if($x[1] == 'unifield_licence'){
						    	$data['output'] =str_replace($matches[0][$i],$this->unifield_licence($x[1]),$data['output']);
						    }
						    else {
						        $data['output'] = str_replace($matches[0][$i],$this->component_render($x[2]),$data['output']);
						    }
						}
						
					}
					////////////////////////////////////
					//main logic
					
						$data['languages'] = $this->Language_model->get_all_language();
						
					////-----all widget pages---------------////
					
					$data['newses'] = $this->Enam_model->all_news();                                 
					$data['news_page'] = $this->load->view('comman/home_notice',$data,TRUE);
					$data['search_page'] = $this->load->view('comman/home_search',$data,TRUE);
					$data['subscribe_page'] = $this->load->view('comman/home_subscribe',$data,TRUE);
					$data['links'] = $this->Enam_model->all_links();
					$data['quickLinks_page'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
					$data['sliders'] = $this->Slider_model->slider_list_client();
					$data['slider_page'] = $this->load->view('pages/comman/slider',$data,TRUE);
					////------------------------------------////
					
					$data['page_id'] = 'page_'.$page_body[0]['page_id'];					
					$data['page_layout'] = $page_body[0]['page_layout'];				
					$data['page_title'] = $page_body[0]['title'];
					$data['keywords'] = $page_body[0]['keywords'];
					$data['title'] = 'eNam | '.$page_body[0]['title'];
					$data['page_title'] = $page_body[0]['title'];
					$data['head'] = $this->load->view('comman/head',$data,TRUE);
					$data['header'] = $this->load->view('comman/header',$data,TRUE);
					$data['menus'] = $this->Enam_model->all_menus();
					$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
					$data['marqueeSection'] = $this->load->view('pages/comman/marqueeSection','',TRUE);
					$data['footer'] = $this->load->view('comman/footer','',TRUE);
					$data['links'] = $this->Enam_model->all_links();
					$data['quickLinks'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
					$data['slider'] = $this->load->view('pages/comman/slider',$data,TRUE);
					$data['newses'] = $this->Enam_model->all_news();
					$data['home_notice'] = $this->load->view('comman/home_notice',$data,TRUE);
					$data['events'] = $this->Event_model->home_list_events();
					$data['main_contant'] = $this->load->view('pages/layout-page',$data,TRUE);
					$this->load->view('comman/index',$data);
				}
				else{
					echo "no record found";
				}
			}
		}
	////////////////////////////	
		if(!count($result)){
			 $this->db->select('p_id as page_id,type');
			 $this->db->limit('1');
			 $result = $this->db->get_Where('pages',array('url'=>$url_array,'status'=>1,'is_static'=>1))->result_array();
			if(count($result)>0){
				$this->db->select('*');
				$page_body = $this->db->get_Where('page_item',array('page_id'=>$result[0]['page_id'],'lang_id'=>(int)$client_laguage,'status'=>1))->result_array();
				
				if($result[0]['type'] == 'que_ans'){
					$this->db->select('qa.*,qai.question,qai.ans');
					$this->db->join('question_ans qa','qa.q_id = qai.qa_id');
                                        $this->db->order_by('qa.q_sort','ASC');
					$page_body['questions'] = $this->db->get_where('question_ans_item qai',array('qa.page_id'=>$result[0]['page_id'],'qai.lang_id'=>(int)$client_laguage,'qai.status'=>1,'qa.status'=>1))->result_array();			
					//print_r($this->db->last_query()); die;
					$questions = array();
					foreach($page_body['questions'] as $key => $value){
					    $str = html_entity_decode($value['ans']);
					    $regex = "/\[(.*?)\]/";
					    $data['output'] = $str;
					    preg_match_all($regex, $str, $matches);
					    
					    for($i =0; $i < count($matches[1]); $i++){
					        $match = $matches[1][$i];
					        $x = explode(':',$match);
						
								if(count($x)>1){
								if($x[1] == 'krimtel'){
									$data['output'] = str_replace($matches[0][$i],$this->page_render($x[2]),$data['output']);
								}
								else if($x[1] == 'imagepath'){
									$data['output'] =str_replace($matches[0][$i],$this->image_path($x[1]),$data['output']);
								}
								else if($x[1] == 'comm_list'){
								    $data['output'] =str_replace($matches[0][$i],$this->comm_list($x[1]),$data['output']);
								}
								else if($x[1] == 'comm_param_list'){
								    $data['output'] =str_replace($matches[0][$i],$this->comm_param_list($x[1]),$data['output']);
								}
								else if($x[1] == 'comm_category_count'){
								    $data['output'] =str_replace($matches[0][$i],$this->comm_category_count($x[1]),$data['output']);
								}
								else if($x[1] == 'unifield_licence'){
									$data['output'] =str_replace($matches[0][$i],$this->unifield_licence($x[1]),$data['output']);
								}
								else {
									$data['output'] = str_replace($matches[0][$i],$this->component_render($x[2]),$data['output']);
								}
							}
					    }
					    $value['ans'] = $data['output'];
					    $questions[] = $value;
					}
					$page_body['questions'] = $questions;
					
				}
				
				if(empty($page_body)){ 
					$data['title'] = 'eNam';
					$data['keywords'] = 'enam home';
					$data['head'] = $this->load->view('comman/head',$data,TRUE);
					$data['languages'] = $this->Language_model->get_all_language();
					$data['header'] = $this->load->view('comman/header',$data,TRUE);
					$data['menus'] = $this->Enam_model->all_menus();
					$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
					$data['footer'] = $this->load->view('comman/footer','',TRUE);
					$data['page_id'] = '404';
					$data['main_contant'] = $this->load->view('error',$data,TRUE);
					$this->load->view('comman/index',$data);
				}
				else{
					$this->db->select('p.page_name,p.page_layout,pc.section,w.name,wi.content,pc.widget_id');
					$this->db->join('page_components pc','(pc.page_id = p.p_id AND pc.status = 1)');
					$this->db->join('widgets w','(w.w_id = pc.widget_id AND w.status = 1)','left');
					$this->db->join('widget_item wi','(wi.widget_id = w.w_id AND wi.status = 1 AND wi.lang_id = '.(int)$client_laguage.')','left');
					$page_component = $this->db->get_where('pages p',array(
							'p.p_id'=>(int)$result[0]['page_id'],
							'p.status' => 1
					))->result_array();
					if(count($page_component)>0){
						$i = 1;
						foreach ($page_component as $pc){
							$page_body[0]['col'][$i] = $pc;
							$i++;
						}
					}						
					$this->db->select('*');
					$page_detail = $this->db->get_where('pages',array('p_id'=>(int)$result[0]['page_id'],'publish'=>1,'status'=>1))->result_array();
					$page_body[0]['page_layout'] = $page_detail[0]['page_layout'];						
					$data['page_contents'] = $page_body;
					
					if(count($data['page_contents']) > 0){
						////////////////////////////////////
						$str = html_entity_decode($data['page_contents'][0]['page_body']);								
						$regex = "/\[(.*?)\]/";
						$data['output'] = $str;
						preg_match_all($regex, $str, $matches);
						for($i =0; $i < count($matches[1]); $i++){
							$match = $matches[1][$i];
							$x = explode(':',$match);								
							if($x[1] == 'krimtel'){
								$data['output'] = str_replace($matches[0][$i],$this->page_render($x[2]),$data['output']);
							}
							else if($x[1] == 'imagepath'){
								$data['output'] = str_replace($matches[0][$i],$this->image_path($x[1]),$data['output']);
							}
							else {
								$data['output'] = str_replace($matches[0][$i],$this->component_render($x[2]),$data['output']);
							}
						}
						////////////////////////////////////
						//main logic
						
							$data['languages'] = $this->Language_model->get_all_language();
							
						
						////-----all widget pages---------------////
						$data['newses'] = $this->Enam_model->all_menus();
						$data['news_page'] = $this->load->view('comman/home_notice',$data,TRUE);
						$data['links'] = $this->Enam_model->all_links();	
						$data['quickLinks_page'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
						$data['sliders'] = $this->Slider_model->slider_list_client();
						$data['slider_page'] = $this->load->view('pages/comman/slider',$data,TRUE);
						$data['search_page'] = $this->load->view('comman/home_search',$data,TRUE);
						$data['subscribe_page'] = $this->load->view('comman/home_subscribe',$data,TRUE);
						////------------------------------------////
						$data['page_id'] = 'page_'.$page_body[0]['page_id'];
						$data['page_layout'] = $page_body[0]['page_layout'];
						$data['page_title'] = $page_body[0]['title'];
						$data['keywords'] = $page_body[0]['keywords'];
						$data['title'] = 'eNam | '.$page_body[0]['title'];
						$data['breadcrum'] = 'eNam | '.$page_body[0]['title'];
						$data['head'] = $this->load->view('comman/head',$data,TRUE);
						$data['header'] = $this->load->view('comman/header',$data,TRUE);
						$data['menus'] = $this->Enam_model->all_menus();
						$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
						$data['marqueeSection'] = $this->load->view('pages/comman/marqueeSection','',TRUE);
						$data['footer'] = $this->load->view('comman/footer','',TRUE);
						$data['links'] = $this->Enam_model->all_links();
						$data['quickLinks'] = $this->load->view('pages/comman/quickLinks',$data,TRUE);
						$data['newses'] = $this->Enam_model->all_news();
						$data['slider'] = $this->load->view('pages/comman/slider',$data,TRUE);
						$data['home_notice'] = $this->load->view('comman/home_notice',$data,TRUE);
						$data['events'] = $this->Event_model->home_list_events();
						$data['main_contant'] = $this->load->view('pages/layout-page',$data,TRUE);
						$this->load->view('comman/index',$data);
					}
					else{
						echo "no record found";
					}
				}
			}
	////////////////////////////		
			else{
				$data['title'] = 'eNam';
				$data['keywords'] = 'enam home';
				$data['head'] = $this->load->view('comman/head',$data,TRUE);
				$data['languages'] = $this->Language_model->get_all_language();
				$data['header'] = $this->load->view('comman/header',$data,TRUE);
				$data['menus'] = $this->Enam_model->all_menus();
				$data['navigation'] = $this->load->view('comman/navigation',$data,TRUE);
				$data['footer'] = $this->load->view('comman/footer','',TRUE);
				$data['page_id'] = '404';
				$data['main_contant'] = $this->load->view('error',$data,TRUE);
				$this->load->view('comman/index',$data);
			}
		}
	}
	
	function image_path(){
		return base_url();
	}
	
	function page_render($str){
		if($str == 'news'){
			
				$data['newses'] = $this->Enam_model->all_menus();
				
			$str = $this->load->view('comman/home_notice',$data,TRUE);
		}
		return $str;
	}
	
	function component_render($str){
		if($this->session->userdata('client_language')){
			$language =  $this->session->userdata('client_language');
		}
		else{
			$language = 1;
		}
		$this->db->select('wi.w_title,wi.content');
		$this->db->join('widget_item wi','wi.widget_id = w.w_id');
		$this->db->join('languages l','l.l_id = wi.lang_id');
		$result = $this->db->get_where('widgets w',array('w.status'=>1,'w.name'=>$str,'wi.lang_id'=>$language,'wi.status'=>1))->result_array();
		
		$str = '<div class="mid-top-space natinal-agricul-market pad">';
		$str.='<h3 class="events-title"><span>'.$result[0]['w_title'].'</span></h3>';
		$str.='<div class="commodity-list">';
		$str.='<div class="box_cont">';  
		$str.='<div style="text-align:justify">';
		$str.= $result[0]['content'];
		$str.='</div>';
		$str.='</div>';
		$str.='</div>';
		$str.='</div>';
		return $str; 
	}
	
	function breadcrum($url_array){
		$result = $this->db->query("select * from menu where id = (SELECT p_id FROM `menu` where cms_url = '$url_array')")->result_array();
		if(count($result)>0){
			$submenu_link = $result[0]['cms_url'];
			return  'eNAM / '.$submenu_link.' / '.$url_array;
		}
		else{
			return  'eNAM / '.$url_array; 
		}
	}
	
	function unifield_licence($str){
		$data = array();
		$l_id = $this->session->userdata('client_language');
		$data['unified'] = $this->db->query("select * from no_unified_licence WHERE created_at = (
                     select created_at from no_unified_licence GROUP by created_at ORDER by created_at DESC LIMIT 1 )")->result_array();
		
		$data['page_id'] = '800';
		$data['head'] = $this->load->view('comman/head',$data,TRUE);
		$data['home_body'] = $this->Widget_model->home_content();
		$data['main_contant'] = $this->load->view('pages/pdf/unified_licence',$data,TRUE);
		$str = $this->load->view('comman/index',$data,true);
		return $str;
	}
	
	function comm_list($str){
	    $data = array();
	    //$l_id = $this->session->userdata('client_language');
	    $l_id = 1;
	    
	    $data['commodity'] = $this->db->query("SELECT c.c_id,ci.commodity_name,cc.cg_name FROM commodities_item ci
		join commodity c on c.c_id = ci.com_id
		join commodity_category cc on cc.c_id = c.g_id
		WHERE ci.lang_id = ".$l_id." and ci.status = 1 and c.status = 1
		order by c.g_id,ci.commodity_name")->result_array();
	    
        $data['page_id'] = '800';
        $data['head'] = $this->load->view('comman/head',$data,TRUE);
        $data['home_body'] = $this->Widget_model->home_content();
        $data['main_contant'] = $this->load->view('pages/pdf/commodity_list',$data,TRUE);
        $str = $this->load->view('comman/index',$data,true);
	    return $str;
	}
	function comm_param_list($str){
	    $data = array();
	    //$l_id = $this->session->userdata('client_language');
	    $l_id = 1;
	    
	    $data['commodity'] = $this->db->query("SELECT c.c_id,ci.commodity_name,cc.cg_name FROM commodities_item ci
		join commodity c on c.c_id = ci.com_id
		join commodity_category cc on cc.c_id = c.g_id
		WHERE ci.lang_id = ".$l_id." and ci.status = 1 and c.status = 1
		order by c.g_id,ci.commodity_name")->result_array();
	    
	    $data['page_id'] = '800';
	    $data['head'] = '';
	    $data['home_body'] = '';
	    $data['main_contant'] = $this->load->view('pages/pdf/commodity_param_list',$data,TRUE);
	    $str = $this->load->view('comman/index',$data,true);
	    return $str;
	}
	
	function comm_category_count($str){
	    $this->db->select("cc.cg_name,count(*) as total");
	    $this->db->join('commodity c','c.g_id = cc.c_id');
	    $this->db->group_by('c.g_id');
	    $result = $this->db->get_where('commodity_category cc',array('c.status'=>1))->result_array();
	    if(count($result)>0){
	        $html = 
                    '<table class="table table-bordered">'.
	                   '<thead>'.
		                  '<tr>'.
			                 '<th>Commodity Category</th>'.
			                 '<th>No. of Commodities</th>'.
		                  '</tr>'.
	                   '</thead>'.
	                   '<tbody>';
            	        foreach($result as $r){
            	            $html .= '<tr><td>'.$r['cg_name'].'</td><td>'.$r['total'].'</td></tr>'; 
            	        }
	                   $html .= '</tbody>'.
                    '</table>';
	    }
	    return $html;
	}
}
