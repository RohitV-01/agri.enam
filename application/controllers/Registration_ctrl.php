<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_ctrl extends CI_Controller {

	function __construct(){
		parent :: __construct();
		$this->load->helper(array('url','file','captcha'));
		$this->load->database();
		$this->load->library('email');
		$this->load->model(array('admin/Language_model','admin/Widget_model','admin/Menu_model','Enam_model'));
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

	
    public function registration_save(){

		if ($_POST) {
			
	    	$fpctypeF = $this->input->post('fpctypeF');
	    	$fpctypeT = $this->input->post('fpctypeT');
	    	$fpctypeA = $this->input->post('fpctypeA');
	    	$fpctypeP = $this->input->post('fpctypeP');

			if ($this->input->post('utype')) {
				$uType = $this->input->post('utype');
			} else{
				$uType='';
			}

			if ($this->input->post('regcat') != 0) {
				$regCat = $this->input->post('regcat');
			} else{
				$regCat='';
			}

			if ($this->input->post('registerlevel')) {
				$registerLevel = $this->input->post('registerlevel');
			} else{
				$registerLevel='';
			}

			if ($this->input->post('mandistate')) {
				$mandiState = $this->input->post('mandistate');
			} else{
				$mandiState='';
			}
			if ($this->input->post('apmcname') == '-select-') {
				$apmcName='';
			} else{
				$apmcName = $this->input->post('apmcname');
			}
			if ($this->input->post('serviceTerritory')) {
				$serviceTerritory = $this->input->post('serviceTerritory');
			} else{
				$serviceTerritory='';
			}

			if ($this->input->post('regiWithEnam')) {
				$regiWithEnam = $this->input->post('regiWithEnam');
			} else{
				$regiWithEnam='';
			}

			if ($this->input->post('applystate') == '-select-') {
				$applyState='';
			} else{
				$applyState = $this->input->post('applystate');
			}

			if ($this->input->post('trader_id')) {
				$traderId = $this->input->post('trader_id');
			} else{
				$traderId='';
			}
			if($this->input->post('nametitle')){
				$nameTitle = $this->input->post('nametitle');
			}else {
				$nameTitle = '';
			}
			if($this->input->post('fname')){
				$fName = $this->input->post('fname');
			}else {
				$fName = '';
			}
			if($this->input->post('mname')){
				$mName = $this->input->post('mname');
			}else {
				$mName = '';
			}
			if($this->input->post('lname')){
				$lName = $this->input->post('lname');
			}else {
				$lName = '';
			}
			if($this->input->post('gender')){
				$gender = $this->input->post('gender');
			}else {
				$gender = '';
			}
			if($this->input->post('reg_dob')){
				$dobVal = $this->input->post('reg_dob');
				$date = str_replace('/', '-', $dobVal);
				$dob = date('Y-m-d', strtotime($date));
			}else {
				$dob = '';
			}
			if($this->input->post('relationtype')){
				$relationType = $this->input->post('relationtype');
			}else {
				$relationType = '';
			}
			if($this->input->post('relationtypename')){
				$relationTypeName = $this->input->post('relationtypename');
			}else {
				$relationTypeName = '';
			}
			if($this->input->post('address')){
				$areaAddress = $this->input->post('address');
			}else {
				$areaAddress = '';
			}
			if($this->input->post('pin')){
				$pin = $this->input->post('pin');
			}else {
				$pin = '';
			}
			if($this->input->post('state')){
				$state = $this->input->post('state');
			}else {
				$state = '';
			}
			if($this->input->post('district')){
				$district = $this->input->post('district');
			}else {
				$district = '';
			}
			if($this->input->post('tehsil')){
				$tehsil = $this->input->post('tehsil');
			}else {
				$tehsil = '';
			}
			if($this->input->post('village') == '-select-'){
				$village = '';
			}else {
				$village = $this->input->post('village');
			}
			if($this->input->post('post')){
				$post = $this->input->post('post');
			}else {
				$post = '';
			}
			if($this->input->post('photoidtype')){
				$photoidtype = $this->input->post('photoidtype');
			}else {
				$photoidtype = '';
			}

			if($this->input->post('idnumber')){
				$idnumber = $this->input->post('idnumber');
			}else {
				$idnumber = '';
			}
			if($this->input->post('mobile')){
				$mobile = $this->input->post('mobile');
			}else {
				$mobile = '';
			}
			if($this->input->post('collection')){
				$collection = $this->input->post('collection');
			}else {
				$collection = '';
			}
			if($this->input->post('email')){
				$email = $this->input->post('email');
			}else {
				$email = '';
			}
			if($this->input->post('unified_license')){
				$unifiedlicense = $this->input->post('unified_license');
			}else {
				$unifiedlicense = '';
			}
			if($this->input->post('company_name')){
				$companyName = $this->input->post('company_name');
			}else {
				$companyName = '';
			}
			if($this->input->post('company_reg')){
				$companyReg = $this->input->post('company_reg');
			}else {
				$companyReg = '';
			}
			if($this->input->post('org_name')){
				$orgName = $this->input->post('org_name');
			}else {
				$orgName = '';
			}
			if($this->input->post('org_address')){
				$orgAddress = $this->input->post('org_address');
			}else {
				$orgAddress = '';
			}
			if($this->input->post('org_cin')){
				$orgCin = $this->input->post('org_cin');
			}else {
				$orgCin = '';
			}
			if($this->input->post('cop_type')){
				$copType = $this->input->post('cop_type');
			}else {
				$copType = '';
			}
			if($this->input->post('landline_no')){
				$landlineNo = $this->input->post('landline_no');
			}else {
				$landlineNo = '';
			}
			if($this->input->post('year_est')){
				$yearEst = $this->input->post('year_est');
			}else {
				$yearEst = '';
			}
			if($this->input->post('gst')){
				$gst = $this->input->post('gst');
			}else {
				$gst = '';
			}
			if($this->input->post('fpcBank')){
				$fpcBank = $this->input->post('fpcBank');
			}else {
				$fpcBank = '';
			}
			if($this->input->post('fpcBankAccountName')){
				$fpcBankAccountName = $this->input->post('fpcBankAccountName');
			}else {
				$fpcBankAccountName = '';
			}
			if($this->input->post('fpcBankAccount')){
				$fpcBankAccount = $this->input->post('fpcBankAccount');
			}else {
				$fpcBankAccount = '';
			}

			if($this->input->post('typeagainaccount')){
				$typeAgainAccount = $this->input->post('typeagainaccount');
			}else {
				$typeAgainAccount = '';
			}

			if($this->input->post('fpcIfsc')){
				$fpcIfsc = strtoupper($this->input->post('fpcIfsc'));
			}else {
				$fpcIfsc = '';
			}

			if($this->input->post('typeagainifsc')){
				$typeAgainIfsc = strtoupper($this->input->post('typeagainifsc'));
			}else {
				$typeAgainIfsc = '';
			}
			
			if($this->input->post('sendSms')){
				$sendSms = $this->input->post('sendSms');
			}else {
				$sendSms = '';
			}
			if($this->input->post('sendEmail')){
				$sendEmail = $this->input->post('sendEmail');
			}else {
				$sendEmail = '';
			}

			if($this->input->post('selectApmcList')){
				$selectApmcList = $this->input->post('selectApmcList');
			}else {
				$selectApmcList = '';
			}

			if($this->input->post('totalturnover')){
				$totalTurnover = $this->input->post('totalturnover');
			}else {
				$totalTurnover = '';
			}

			if($this->input->post('base64_passbook')){
				$basePassbook = $this->input->post('base64_passbook');
			}else {
				$basePassbook = '';
			}

			if($this->input->post('base64_idproof')){
				$baseIdproof = $this->input->post('base64_idproof');
			}else {
				$baseIdproof = '';
			}

			if($this->input->post('base64_certificate')){
				$baseCertificate = $this->input->post('base64_certificate');
			}else {
				$baseCertificate = '';
			}

			if($this->input->post('fpo_org_pin')){
				$fpoPin = $this->input->post('fpo_org_pin');
			}else{
				$fpoPin = '';
			}

			if($this->input->post('fpo_state')){
				$fpoState = $this->input->post('fpo_state');
				$fpoStateName = substr($fpoState, strpos($fpoState, "-") + 1); 
				$fpoStateId = strstr($fpoState, '-', true);     
			}else{
				$fpoStateName = '';
				$fpoStateId = '';
			}

			if($this->input->post('fpo_district')){
				$fpoDistrict = $this->input->post('fpo_district');
				$fpoDistName = substr($fpoDistrict, strpos($fpoDistrict, "-") + 1);    
				$fpoDistId = strstr($fpoDistrict, '-', true);   
				
			}else{
				$fpoDistName = '';
				$fpoDistId = '';
			}

			if($this->input->post('fpo_tehsil')){
				$fpoTehsil = $this->input->post('fpo_tehsil');
				$fpoTehsilName = substr($fpoTehsil, strpos($fpoTehsil, "-") + 1);    
				$fpoTehsilId = strstr($fpoTehsil, '-', true);   
			}else{
				$fpoTehsilName = '';
				$fpoTehsilId = '';
			}

			if($this->input->post('fpo_village')){
				$fpoVillage = $this->input->post('fpo_village');
				$fpoVillageName = substr($fpoVillage, strpos($fpoVillage, "-") + 1);    
				 
			}else{
				$fpoVillageName = '';
			}

			if($this->input->post('fpo_estdate')){
				$fpoEstDateVal = $this->input->post('fpo_estdate');
				$dateNew = str_replace('/', '-', $fpoEstDateVal);
				$fpoEstDate = date('Y-m-d', strtotime($dateNew));
			}else{
				$fpoEstDate = '';
			}

			if($this->input->post('license_fromDate')){
				$fromDateInput = $this->input->post('license_fromDate');
				$fromDateVal = str_replace('/', '-', $fromDateInput);
				$licenseFromDateVal = date('Y-m-d', strtotime($fromDateVal));

				$timestampForValidFrom = strtotime($licenseFromDateVal);
				$formatValidDateFrom = date("d/m/Y", $timestampForValidFrom);
			}else{
				$formatValidDateFrom = '';
			}

			if($this->input->post('license_toDate')){
				$toDateInput = $this->input->post('license_toDate');
				//echo "date check".$toDateInput;
				$toDateVal = str_replace('/', '-', $toDateInput);
				$licenseToDateVal = date('Y-m-d', strtotime($toDateVal));

				$timestampForValidTo = strtotime($licenseToDateVal);
				$formatValidDateTo = date("d/m/Y", $timestampForValidTo);
			}else{
				$formatValidDateTo = '';
			}

			if($this->input->post('firm_add')){
				$firmAdd = $this->input->post('firm_add');
			}else{
				$firmAdd = '';
			}

			//$uploadUnifiedLicense = $_POST['uploadUnifiedLicense'];

			$test1 = $_POST['uploadUnifiedLicense'];

			if($test1 == '[{"docFile":[]}]'){
				$uploadUnifiedLicense = '';
			}else{
				$uploadUnifiedLicense=$test1;
			}


			if($this->input->post('notifyDeNotify')){
				$notifyVal = $this->input->post('notifyDeNotify');
			}else{
				$notifyVal = '';
			}

			if($this->input->post('unifiedNotifyDeNotify ')){
				$unifiedNotifyDeNotifyVal  = $this->input->post('unifiedNotifyDeNotify ');
			}else{
				$unifiedNotifyDeNotifyVal  = '';
			}

			//idproof //userLogFiles

			if(!empty($_FILES['passbook']['name'])){
				echo "passbook name condition";
				// $passBookImg = $_FILES['passbook']['name'];
				$file_name = $_FILES['passbook']['name'];
				$story_file = $fName;
				$x = explode('.',$file_name);
				$_FILES['userFile']['name'] = $story_file.'_passbook.'.end($x);
				$_FILES['userFile']['type'] = $_FILES['passbook']['type'];
				$_FILES['userFile']['tmp_name'] = $_FILES['passbook']['tmp_name'];
				$_FILES['userFile']['error'] = $_FILES['passbook']['error'];
				$_FILES['userFile']['size'] = $_FILES['passbook']['size'];
					

				if(is_dir('./assest/images/user-register/')){
					$uploadPath = './assest/images/user-register/';
				}
				else{
					mkdir('./assest/images/user-register/');
					$uploadPath = './assest/images/user-register/';
				}
				$config['overwrite'] = true;
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpg|png|jpeg|pdf|JPG|PNG|JPEG|PDF';

				$this->load->library('image_lib');
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('userFile')){
					$upload_data = $this->upload->data();
					$passBookImg = $upload_data['file_name'];
					
				}
				else{
					$error = array('error' => $this->upload->display_errors());
					print_r($error); die;
				}
			}else{
				$passBookImg = "";
			}

			//for id proof upload
			if(!empty($_FILES['idproof']['name'])){
				echo "idproof name condition";
				// $idProofImg = $_FILES['idproof']['name'];
				$file_name = $_FILES['idproof']['name'];

				$story_file = $fName;
				$x = explode('.',$file_name);
				$_FILES['userFile']['name'] = $story_file.'_idproof.'.end($x);
				$_FILES['userFile']['type'] = $_FILES['idproof']['type'];
				$_FILES['userFile']['tmp_name'] = $_FILES['idproof']['tmp_name'];
				$_FILES['userFile']['error'] = $_FILES['idproof']['error'];
				$_FILES['userFile']['size'] = $_FILES['idproof']['size'];
					

				if(is_dir('./assest/images/user-register/')){
					$uploadPath = './assest/images/user-register/';
				}
				else{
					mkdir('./assest/images/user-register/');
					$uploadPath = './assest/images/user-register/';
				}
				$config['overwrite'] = true;
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpg|png|jpeg|pdf|JPG|PNG|JPEG|PDF';

				$this->load->library('image_lib');
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('userFile')){
					$upload_data = $this->upload->data();
					$idProofImg = $upload_data['file_name'];
					
				}
				else{
					$error = array('error' => $this->upload->display_errors());
					print_r($error); die;
				}
			}else{
				$idProofImg = "";
			}

			//for company registration certificate
			if(!empty($_FILES['companyproof']['name'])){
				echo "companyproof name condition";
				 // $companyproofImg = $_FILES['companyproof']['name'];
				$file_name = $_FILES['companyproof']['name'];

				$story_file = $orgName;
				$x = explode('.',$file_name);
				$_FILES['userFile']['name'] = $story_file.'_certificate.'.end($x);
				$_FILES['userFile']['type'] = $_FILES['companyproof']['type'];
				$_FILES['userFile']['tmp_name'] = $_FILES['companyproof']['tmp_name'];
				$_FILES['userFile']['error'] = $_FILES['companyproof']['error'];
				$_FILES['userFile']['size'] = $_FILES['companyproof']['size'];
					

				if(is_dir('./assest/images/user-register/')){
					$uploadPath = './assest/images/user-register/';
				}
				else{
					mkdir('./assest/images/user-register/');
					$uploadPath = './assest/images/user-register/';
				}
				$config['overwrite'] = true;
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpg|png|jpeg|pdf|JPG|PNG|JPEG|PDF';

				$this->load->library('image_lib');
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('userFile')){
					$upload_data = $this->upload->data();
					$companyproofImg = $upload_data['file_name'];
					
				}
				else{
					$error = array('error' => $this->upload->display_errors());
					print_r($error); die;
				}
			}else{
				$companyproofImg = "";
			}

			//for userLog Files upload
			if(!empty($_FILES['userLogFiles']['name'])){
				echo "userlog file name condition";
				 // $userLogImg = $_FILES['userLogFiles']['name'];
				$file_name = $_FILES['userLogFiles']['name'];

				$story_file = date('U');
				$x = explode('.',$file_name);
				$_FILES['userFile']['name'] = $story_file.'.'.end($x);
				$_FILES['userFile']['type'] = $_FILES['userLogFiles']['type'];
				$_FILES['userFile']['tmp_name'] = $_FILES['userLogFiles']['tmp_name'];
				$_FILES['userFile']['error'] = $_FILES['userLogFiles']['error'];
				$_FILES['userFile']['size'] = $_FILES['userLogFiles']['size'];
					

				if(is_dir('./assest/images/user-register/')){
					$uploadPath = './assest/images/user-register/';
				}
				else{
					mkdir('./assest/images/user-register/');
					$uploadPath = './assest/images/user-register/';
				}
				$config['overwrite'] = true;
				$config['upload_path'] = $uploadPath;
				$config['allowed_types'] = 'jpg|png|jpeg|pdf|JPG|PNG|JPEG|PDF';

				$this->load->library('image_lib');
				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if($this->upload->do_upload('userFile')){
					$upload_data = $this->upload->data();
					$userLogImg = $upload_data['file_name'];
					
				}
				else{
					$error = array('error' => $this->upload->display_errors());
					print_r($error); die;
				}
			}else{
				$userLogImg = "";
			}

			
		$timestamp = strtotime($dob);
		$formatDate = date("d/m/Y", $timestamp);

		$inputCaptcha = $this->input->post('captcha');
        $sessCaptcha = $this->session->userdata('captchaCode');

        if($inputCaptcha === $sessCaptcha){
        	
        }else{
        	echo "Entered Captcha is not matched.";die();
        }
        echo "user type =".$uType;

		if($uType == "F") {
			echo "user type F array condition in F";
			$data = array(
				"language" => "en",
				"registerlevel"=> $registerLevel,
				"utype" => $uType,
				"mandistate"=> $mandiState,
				"apmcname"    => $apmcName,
				"nametitle"=> $nameTitle,
				"fname"=> $fName,
				"mname"=> $mName,
				"lname"=> $lName,
				"gender"=> $gender,
				"dob"=> $formatDate,
				"relationtype"=> $relationType,
				"relationtypename"=> $relationTypeName,
				"area"=> $areaAddress,
				"city"=> $village,

				"post"=> $post,
				"pin"=> $pin,

				"state"=> $state,
				"district"=> $district,
				"tehsil"=> $tehsil,

				"photoidtype"=> $photoidtype,
				"idnumber"=> $idnumber,
				"mobile"=> $mobile,
				"email"=> $email,

				"fpcBankAccountName"=> $fpcBankAccountName,
				"fpcBank"=> $fpcBank,
				"fpcBankAccount"=> $fpcBankAccount,
				"fpcIfsc"=> $fpcIfsc,

				"typeagainaccount"=> $typeAgainAccount,
				"typeagainifsc"=> $typeAgainIfsc,

				"fpctypeF"=> $fpctypeF,

				"fpoStateId" => $fpoStateId,
				"fpoStateName" => $fpoStateName,
				"fpoDistrictId" => $fpoDistId,
				"fpoDistrictName" => $fpoDistName,
				"fpoTehsilId" => $fpoTehsilId,
				"fpoTehsilName" => $fpoTehsilName,
				"fpoCityName" => $fpoVillageName,
				"fpoPinCode" => $fpoPin,
				"fpoEstDate" => $fpoEstDate,

				"companyregno"=> $companyReg,
				"collection"=> $collection,

				"org_name"=> $orgName,
				"org_address"=> $orgAddress,
				"org_cin"=> $orgCin,

				"compCertificateExt" => $companyproofImg,
				"fnameIdProofExt" => $idProofImg,
				"fnamePassbookExt" => $passBookImg,

				"idproof"=> str_replace("[removed]", "",$baseIdproof),
				"passbook"=> str_replace("[removed]", "",$basePassbook),
				"companyCertificate" => str_replace("[removed]", "",$baseCertificate),


				"sendSms"=> $sendSms,
				"sendEmail"=> $sendEmail,

				// "serviceTerritory"=> $serviceTerritory,
				"serviceTerritory"=> "0",
				// "totalturnover" => $totalTurnover,
				"totalturnover" => "",              
				// "nonEnamMandi" => $regiWithEnam,
				"nonEnamMandi" => "",
				// "applystate"=> $applyState,
				"applystate"=> "0",
				// "apmclicenseno" => $unifiedlicense,
				"apmclicenseno" => "",
				// "companyname"=> $companyName,	
				"companyname"=>"",			
				// "landline"=> $landlineNo,
				"landline"=> "",
				// "yearofestablish" => $yearEst,
				"yearofestablish" => "",
				// "gst"=> $gst,
				"gst"=> "",
				// "userLogFiles"=> $userLogImg,	
				"userLogFiles"=> "",				
				// "coperative_type" => $copType,
				"coperative_type" => ""
				
				
					     
            );

			$data = http_build_query($data);
	  		
			$url = 'https://enam.gov.in/NamWebSrv/rest/mobile/userRegistrationWeb';
			
			// use key 'http' even if you send the request to https://...
	
			$opts = array('http' =>
			    array(
			        'method'  => 'POST',
			        'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
                		. "Content-Length: " . strlen($data) . "\r\n",
            		'content' => $data
			    )
			);
		
			$context  = stream_context_create($opts);
			$result = file_get_contents($url, false, $context);
			
			$aa = json_decode($result);
			$stdObjectToArr = array($aa);

			if ($stdObjectToArr[0]->statusMsg == "S") {
				echo "if responce is Successfully get in F";
				if($sendEmail == 'N'){
				echo "email receive condition in F";	
						$curl = curl_init();

						curl_setopt_array($curl, array(
						  CURLOPT_URL => 'https://enam.gov.in/UtilityAppWS/rest/sendEmail',
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'POST',
						  CURLOPT_POSTFIELDS =>'{
						    "toUser": "'.$email.'",
						    "userName":"'.$fName." ".$lName.'"
						    
						}',
						  CURLOPT_HTTPHEADER => array(
						    'Content-Type: application/json',
						    'Cookie: SERVERID=node44'
						  ),
						));

						$response = curl_exec($curl);

						curl_close($curl);
						if($response == 'Y'){
							echo "if responce is Successfully in F";
							echo json_encode(array('msg'=>'User registered Successfully','status'=>200));
						}
						

				}
				// echo json_encode(array('msg'=>'User registered Successfully','status'=>200));
			}
			if($stdObjectToArr[0]->statusMsg == "F")
			{
				echo "if responce is failed in F";
				echo json_encode(array('msg'=>$stdObjectToArr[0]->message,'status'=>500));	

			}

		}
  
		if($uType == "T") {
  echo "user type T condition start";
			$data = array(
				"language" => "en",
				"registerlevel"=> $registerLevel,
				"utype" => $uType,
				"mandistate"=> $mandiState,
				"apmcname"=> $apmcName,
				"nametitle"=> $nameTitle,
				"fname"=> $fName,
				"mname"=> $mName,
				"lname"=> $lName,
				"gender"=> $gender,
				"dob"=> $formatDate,
				"relationtype"=> $relationType,
				"relationtypename"=> $relationTypeName,
				"area"=> $areaAddress,
				"city"=> $village,
				"post"=> $post,
				"pin"=> $pin,
				"state"=> $state,
				"district"=> $district,
				"tehsil"=> $tehsil,
				"photoidtype"=> $photoidtype,
				"idnumber"=> $idnumber,
				"mobile"=> $mobile,
				"email"=> $email,

				"fpcBankAccountName"=> $fpcBankAccountName,
				"fpcBank"=> $fpcBank,
				"fpcBankAccount"=> $fpcBankAccount,
				"fpcIfsc"=> $fpcIfsc,

				"typeagainaccount"=> $typeAgainAccount,
				"typeagainifsc"=> $typeAgainIfsc,
				"fpctypeT"=> $fpctypeT,
				"sendSms"=> $sendSms,
				"sendEmail"=> $sendEmail,

				"idproof"=> str_replace("[removed]", "",$baseIdproof),
				"passbook"=> str_replace("[removed]", "",$basePassbook),

				"org_name"=> $orgName,
				"org_address"=> $firmAdd,
				"org_cin"=> $orgCin,
				"collection"=> $collection,

					"serviceTerritory"=> "0",
				// "totalturnover" => $totalTurnover,
				"totalturnover" => "",              
				// "nonEnamMandi" => $regiWithEnam,
				"nonEnamMandi" => "",
				// "applystate"=> $applyState,
				"applystate"=> "0",
				// "apmclicenseno" => $unifiedlicense,
				"apmclicenseno" => "",
				// "companyname"=> $companyName,	
				"companyname"=>"",			
				// "landline"=> $landlineNo,
				"landline"=> "",
				// "yearofestablish" => $yearEst,
				"yearofestablish" => "",
				// "gst"=> $gst,
				"gst"=> "",
				// "userLogFiles"=> $userLogImg,	
				"userLogFiles"=> "",				
				// "coperative_type" => $copType,
				"coperative_type" => "",
				

				// "serviceTerritory"=> $serviceTerritory,
				// "totalturnover" => $totalTurnover,             
				// "nonEnamMandi" => $regiWithEnam,
				// "applystate"=> $applyState,
				// "apmclicenseno" => $unifiedlicense,
				// "companyname"=> $companyName,
				// "companyregno"=> $companyReg,
				// "landline"=> $landlineNo,
				// "yearofestablish" => $yearEst,
				// "gst"=> $gst,
				// "userLogFiles"=> $userLogImg,							
				// "coperative_type" => $copType,

				// "multiApmcIds" => $selectApmcList,
				"multiApmcIds" => "",

				"licenseValidFromDate" => $formatValidDateFrom,
				"licenseValidToDate" => $formatValidDateTo,

				// "uploadUnifiedLicense" => $uploadUnifiedLicense,
				"uploadUnifiedLicense" => "",

				"notifyDeNotify"=> $notifyVal,
 				"enamLoginId"=> $traderId,
 				"unifiedNotifyDeNotify"=>$unifiedNotifyDeNotifyVal		
					     
            );
			//print_r($data);
			$data = http_build_query($data);
	  		
			$url = 'https://enam.gov.in/NamWebSrv/rest/mobile/userRegistrationWeb';
			
			// use key 'http' even if you send the request to https://...
	
			$opts = array('http' =>
			    array(
			        'method'  => 'POST',
			        'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
                		. "Content-Length: " . strlen($data) . "\r\n",
            		'content' => $data
			    )
			);
			
			$context  = stream_context_create($opts);
			$result = file_get_contents($url, false, $context);
			//print_r($result);
			
			$aa = json_decode($result);
			$stdObjectToArr = array($aa);
			//print($stdObjectToArr);

			if ($stdObjectToArr[0]->statusMsg == "S") {
				  echo "Responce get Successfully in condition in T";
				if($sendEmail == 'N'){
				  echo "Responce get email in condition in T";	
						$curl = curl_init();

						curl_setopt_array($curl, array(
						  CURLOPT_URL => 'https://enam.gov.in/UtilityAppWS/rest/sendEmail',
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'POST',
						  CURLOPT_POSTFIELDS =>'{
						    "toUser": "'.$email.'",
						    "userName":"'.$fName." ".$lName.'"
						    
						}',
						  CURLOPT_HTTPHEADER => array(
						    'Content-Type: application/json',
						    'Cookie: SERVERID=node44'
						  ),
						));

						$response = curl_exec($curl);

						curl_close($curl);
						if($response == 'Y'){
							  echo "Responce get failed in condition in T";
							echo json_encode(array('msg'=>'User registered Successfully','status'=>200));
						}
						

				}

				// echo json_encode(array('msg'=>'User registered Successfully','status'=>200));
			}
			if($stdObjectToArr[0]->statusMsg == "F")
			{
				echo json_encode(array('msg'=>$stdObjectToArr[0]->message,'status'=>500));	
			}
		}

		if($uType == "A") {

			$data = array(
				"language" => "en",
				"registerlevel"=> $registerLevel,
				"utype" => $uType,
				"mandistate"=> $mandiState,
				"apmcname"    => $apmcName,
				"nametitle"=> $nameTitle,
				"fname"=> $fName,
				"mname"=> $mName,
				"lname"=> $lName,
				"gender"=> $gender,
				"dob"=> $formatDate,
				"relationtype"=> $relationType,
				"relationtypename"=> $relationTypeName,
				"area"=> $areaAddress,
				"city"=> $village,
				"post"=> $post,
				"pin"=> $pin,
				"state"=> $state,
				"district"=> $district,
				"tehsil"=> $tehsil,
				"photoidtype"=> $photoidtype,
				"idnumber"=> $idnumber,
				"mobile"=> $mobile,
				"email"=> $email,

				"fpcBankAccountName"=> $fpcBankAccountName,
				"fpcBank"=> $fpcBank,
				"fpcBankAccount"=> "$fpcBankAccount",
				"fpcIfsc"=> $fpcIfsc,
				"typeagainaccount"=> "$typeAgainAccount",
				"typeagainifsc"=> $typeAgainIfsc,
				"fpctypeA"=> $fpctypeA,
				"sendSms"=> $sendSms,
				"sendEmail"=> $sendEmail,
				"idproof"=> str_replace("[removed]", "",$baseIdproof),
				"passbook"=> str_replace("[removed]", "",$basePassbook),
				"serviceTerritory"=> $serviceTerritory,
				"totalturnover" => $totalTurnover,             
				"nonEnamMandi" => $regiWithEnam,
				"applystate"=> $applyState,
				//"altmobile" => "9822434231",
				"apmclicenseno" => $unifiedlicense,
				"companyname"=> $companyName,
				"companyregno"=> $companyReg,
				"landline"=> $landlineNo,
				"yearofestablish" => $yearEst,
				"gst"=> $gst,
				"userLogFiles"=> $userLogImg,
				"collection"=> $collection,
				"org_name"=> $orgName,
				"org_address"=> $orgAddress,
				"org_cin"=> $orgCin,
				"coperative_type" => $copType
					     
            );

           
			$data = http_build_query($data);
	  
			$url = 'https://enam.gov.in/NamWebSrv/rest/mobile/userRegistrationWeb';
			
			$opts = array('http' =>
			    array(
			        'method'  => 'POST',
			        'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
                		. "Content-Length: " . strlen($data) . "\r\n",
            		'content' => $data
			    )
			);
			$context  = stream_context_create($opts);
			$result = file_get_contents($url, false, $context);
			$aa = json_decode($result);
			$stdObjectToArr = array($aa);
			
			if ($stdObjectToArr[0]->statusMsg == "S") {
				if($sendEmail == 'N'){	
						$curl = curl_init();

						curl_setopt_array($curl, array(
						  CURLOPT_URL => 'https://enam.gov.in/UtilityAppWS/rest/sendEmail',
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'POST',
						  CURLOPT_POSTFIELDS =>'{
						    "toUser": "'.$email.'",
						    "userName":"'.$fName." ".$lName.'"
						    
						}',
						  CURLOPT_HTTPHEADER => array(
						    'Content-Type: application/json',
						    'Cookie: SERVERID=node44'
						  ),
						));

						$response = curl_exec($curl);

						curl_close($curl);
						if($response == 'Y'){
							echo json_encode(array('msg'=>'User registered Successfully','status'=>200));
						}
						

				}
				// echo json_encode(array('msg'=>'User registered Successfully','status'=>200));

			}
			if($stdObjectToArr[0]->statusMsg == "F")
			{
				echo json_encode(array('msg'=>$stdObjectToArr[0]->message,'status'=>500));	

			}
		}

		if($uType == "P") {

			$data = array(
				"language" => "en",
				"registerlevel"=> $registerLevel,
				"utype" => $uType,
				"mandistate"=> $mandiState,
				"apmcname"    => $apmcName,
				"nametitle"=> $nameTitle,
				"fname"=> $fName,
				"mname"=> $mName,
				"lname"=> $lName,
				"gender"=> $gender,
				"dob"=> $formatDate,
				"relationtype"=> $relationType,
				"relationtypename"=> $relationTypeName,
				"area"=> $areaAddress,
				"city"=> $village,
				"post"=> $post,
				"pin"=> $pin,
				"state"=> $state,
				"district"=> $district,
				"tehsil"=> $tehsil,
				"photoidtype"=> $photoidtype,
				"idnumber"=> $idnumber,
				"mobile"=> $mobile,
				"email"=> $email,
				"fpcBankAccountName"=> $fpcBankAccountName,
				"fpcBank"=> $fpcBank,
				"fpcBankAccount"=> "$fpcBankAccount",
				"fpcIfsc"=> $fpcIfsc,
				"typeagainaccount"=> "$typeAgainAccount",
				"typeagainifsc"=> $typeAgainIfsc,
				"fpctypeP"=> $fpctypeP,
				"sendSms"=> $sendSms,
				"sendEmail"=> $sendEmail,
				"idproof"=> str_replace("[removed]", "",$baseIdproof),
				"passbook"=> str_replace("[removed]", "",$basePassbook),
				"serviceTerritory"=> $serviceTerritory,
				"totalturnover" => "5500",             
				"nonEnamMandi" => $regiWithEnam,
				"applystate"=> $applyState,
				//"altmobile" => "9822434231",
				"apmclicenseno" => $unifiedlicense,
				"companyname"=> $companyName,
				"companyregno"=> $companyReg,
				"landline"=> $landlineNo,
				"yearofestablish" => $yearEst,
				"gst"=> $gst,
				"userLogFiles"=> $userLogImg,
				"collection"=> $collection,
				"org_name"=> $orgName,
				"org_address"=> $orgAddress,
				"org_cin"=> $orgCin,
				"coperative_type" => $copType
					     
            );

			$data = http_build_query($data);
	  		
			$url = 'https://enam.gov.in/NamWebSrv/rest/mobile/userRegistrationWeb';
			
			// use key 'http' even if you send the request to https://...
	
			$opts = array('http' =>
			    array(
			        'method'  => 'POST',
			        'header'=> "Content-type: application/x-www-form-urlencoded\r\n"
                		. "Content-Length: " . strlen($data) . "\r\n",
            		'content' => $data
			    )
			);
			
			$context  = stream_context_create($opts);
			$result = file_get_contents($url, false, $context);
		
			$aa = json_decode($result);
			$stdObjectToArr = array($aa);
			
			if ($stdObjectToArr[0]->statusMsg == "S") {
				if($sendEmail == 'N'){	
						$curl = curl_init();

						curl_setopt_array($curl, array(
						  CURLOPT_URL => 'https://enam.gov.in/UtilityAppWS/rest/sendEmail',
						  CURLOPT_RETURNTRANSFER => true,
						  CURLOPT_ENCODING => '',
						  CURLOPT_MAXREDIRS => 10,
						  CURLOPT_TIMEOUT => 0,
						  CURLOPT_FOLLOWLOCATION => true,
						  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
						  CURLOPT_CUSTOMREQUEST => 'POST',
						  CURLOPT_POSTFIELDS =>'{
						    "toUser": "'.$email.'",
						    "userName":"'.$fName." ".$lName.'"
						    
						}',
						  CURLOPT_HTTPHEADER => array(
						    'Content-Type: application/json',
						    'Cookie: SERVERID=node44'
						  ),
						));

						$response = curl_exec($curl);

						curl_close($curl);
						if($response == 'Y'){
							echo json_encode(array('msg'=>'User registered Successfully','status'=>200));
						}
						

				}
				// echo json_encode(array('msg'=>'User registered Successfully','status'=>200));

			}
			if($stdObjectToArr[0]->statusMsg == "F")
			{
				echo json_encode(array('msg'=>$stdObjectToArr[0]->message,'status'=>500));	

			}


		}
						
	
		}
	}
	




}
?>












	