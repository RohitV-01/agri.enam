<html>
	</head>
		<script src="<?php echo base_url();?>assest/admin/js/jquery.form.js"></script>
	<!------------------------------------------------------------------------------------------------------------------------------------->
		<style>
		.form-t-title{width:100%; background:#F5f5f5; text-align:left; padding:10px; margin:20px auto; font-weight:bold;}
		</style>
	</head>

<section class="title-header-bg-apmc"></section>

	<div class="container-fuild" style="padding-left:4%;padding-right:4%;">
<div class="col-md-12 bc-nav" ><a href="<?php echo base_url(); ?>" title="">Home</a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp; Registration</div>
		<div class="col-md-offset-1 col-lg-10 col-md-10 col-sm-10 col-xs-12" style="    background-color: #d4d4d4;    border-radius: 4px;    margin-top: 20px;    margin-bottom: 20px;">
		<form id="registration_form"  name="f1" method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>/NAM/register">
			<div class="form-t-title">Fill Following Information</div>
				 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-bottom:15px;">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						Registration Level
						<span style="color:#F00">*</span> :
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input type="radio" class="reg_level" name="registerlevel" value="state"> State
						<input type="radio" class="reg_level" checked="" name="registerlevel" value="apmc"> APMC
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-bottom:15px;">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						Unified License :
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<input type="text" name="unified-license" class="form-control" placeholder="unified license">
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-bottom:25px;">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						Registration Type
						<span style="color:#F00">*</span> :
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<select class="form-control" name="utype" id="regtype">
							<option value="0">Select Please</option>
							<option value="seller">Seller</option>
							<option value="buyer">Buyer</option>
							<option value="commi_agent">Commission Agent</option>
							<option value="ser_pro">Service Provider</option>
						</select>
						<div class="text-danger" id="regtype_error" style="display:none;"></div>
					</div>
				</div>

				<div style="display: none;" class="mydisplayboxfpcT">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-bottom:25px;">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							Registration Category 
							<span style="color:#F00">*</span>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<select class="form-control" name="regcat" onchange="showboxfpcfpo(this.value)" onfocus="clearApmcT(this);" id="regcat">
								<option value="0">Select Please</option>
								<option value="TA">Trader</option>
								<option value="CA">Commission Agent</option>
								<option value="CO">Co-Operative</option>
								<option value="EX">Exporter</option>
								<option value="PO">Processor</option>
								<option value="GA">Government Agency</option>
								<option value="RT">Retailor</option>
								<option value="AG">Aggregator</option>
								<option value="FF">FPO/FPC</option>
								<option value="OT">Other</option>
							</select>
						</div>
					</div>
				</div>

				<div style="display: none;" class="mydisplayboxfpcF">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-bottom:25px;">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							Registration Category
							<span style="color:#F00">*</span>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<select class="form-control" name="fpctypeF"  id="fpctypeF">
								<option value="0">Select Please</option>
								<option value="IF">Individual Farmer</option>
								<option value="FG">Farmer Group</option>
								<option value="CO">Co-Operative</option>
								<option value="TA">Trader</option>
								<option value="AG">Aggregator</option>
								<option value="CA">Commission Agent</option>
								<option value="FF">FPO/FPC</option>
								<option value="GA">Government Agency</option>
								<option value="OT">Other</option>
							</select>
						</div>
					</div>
				</div>
				
				<div style="display: none;" class="mydisplayboxbuy">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-bottom:25px;">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							Registration Category
							<span style="color:#F00">*</span>
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<select class="form-control" name="fpctypeF"  id="fpctype">
								<option value="0">Select Please</option>
								<option value="TA">Trader</option>
								<option value="CA">Commission Agent</option>
								<option value="CO">Co-Operative</option>
								<option value="EX">Exporter</option>
								<option value="PO">Processor</option>
								<option value="GA">Government Agency</option>
								<option value="RT">Retailor</option>
								<option value="AG">Aggregator</option>
								<option value="FF">FPO/FPC</option>
								<option value="OT">Other</option>
							</select>
						</div>
					</div>
				</div>

				<div style="display: none;" class="mydisplayboxfpcSP">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-bottom:25px;">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							Registration Category
							<span style="color:#F00">*</span>

						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<select class="form-control" name="fpctypeP" id="fpctypeP">
								<option value="0">Select Please</option>
								<option value="HA">Hamal</option>
								<option value="LP">Logistic Provider</option>
								<option value="LU">Loader / Unloader</option>
								<option value="GD">Grader</option>
								<option value="WH">Warehouse</option>
								<option value="CS">Cold Storage Operator</option>
								<option value="PK">Packer</option>
								<option value="QA">Quality Assayer</option>
								<option value="OT">Other</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-bottom:25px;">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						State
						<span style="color:#F00">*</span> :
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<select class="form-control" name="mandistate"  id="regstate">
								<option selected="" value="0">Select Please</option>
							<option value="AP-276-ANDHRA PRADESH">ANDHRA PRADESH</option><option value="CH-526-CHANDIGARH">CHANDIGARH</option><option value="CG-100-CHHATTISGARH">CHHATTISGARH</option><option value="GJ-22-GUJARAT">GUJARAT</option><option value="HR-32-HARYANA">HARYANA</option><option value="HP-43-HIMACHAL PRADESH">HIMACHAL PRADESH</option><option value="JH-47-JHARKHAND">JHARKHAND</option><option value="MP-20-MADHYA PRADESH">MADHYA PRADESH</option><option value="MH-296-MAHARASHTRA">MAHARASHTRA</option><option value="OD-384-ODISHA">ODISHA</option><option value="PC-599-PUDUCHERRY">PUDUCHERRY</option><option value="PB-602-PUNJAB">PUNJAB</option><option value="RJ-26-RAJASTHAN">RAJASTHAN</option><option value="TN-509-TAMIL NADU">TAMIL NADU</option><option value="TS-28-TELANGANA">TELANGANA</option><option value="UP-46-UTTAR PRADESH">UTTAR PRADESH</option><option value="UT-385-UTTARAKHAND">UTTARAKHAND</option><option value="WB-569-WEST BENGAL">WEST BENGAL</option>
						</select>
						<div class="text-danger" id="regstate_error" style="display:none;"></div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" id="apmc_name">
					<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
						Registering with
						<span style="color:#F00">*</span> :
					</div>
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<select class="form-control" name="apmcname" id="reg_with">
						   <option selected="" value="0">Select Please</option>
						</select>
						<div class="text-danger" id="reg_with_error" style="display:none;"></div>
					</div>
				</div>
				<div class="clearfix"></div>
															
	<!---------------- changes farmer registration ------------------------------------->
				<div class="form-t-title">Registration Form</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
								Title <span style="color:#F00">*</span> :
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
								<select class="form-control" name="nametitle" id="nametitle">
									<option value="0">Select Please</option>
									<option>Mr.</option>
									<option>Mrs.</option>
									<option>Ms.</option>
								</select>
								<div class="text-danger" id="nametitle_error" style="display:none;"></div>
							</div>
						</div>
						
						 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
								First Name <span style="color:#F00">*</span> :
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
							   <input type="text" autocomplete="off" class="form-control" name="fname" id="reg_fname" maxlength="40">
							   <div class="text-danger" id="reg_fname_error" style="display:none;"></div>
							</div>
						</div>
					</div>
					<div class="row">
						  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
							   Middle Name :
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
							   <input type="text" autocomplete="off" class="form-control" name="mname" id="reg_mname" maxlength="20">
							   <div class="text-danger" id="reg_mname_error" style="display:none;"></div>
							</div>
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 ">
							 Last Name <span style="color:#F00">*</span> :
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 ">
							   <input type="text" autocomplete="off" class="form-control" name="lname" id="reg_lname" maxlength="40">
							   <div class="text-danger" id="reg_lname_error" style="display:none;"></div>
							</div>
						</div>
					</div>
					<div class="row">
						 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							Gender <span style="color:#F00">*</span> :
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<select class="form-control" name="gender" id="reg_gender">
								<option value="0">Select Please</option>
								<option value="M">Male</option>
								<option value="F">Female</option>
							</select>
							<div class="text-danger" id="reg_gender_error" style="display:none;"></div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							Date of Birth <span style="color:#F00">*</span> :
						</div>
						<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
							<input type="text" autocomplete="off" class="form-control" name="dob" readonly="readonly" id="reg_dob" placeholder="DD/MM/YYYY">
							<div class="text-danger" id="reg_dob_error" style="display:none;"></div>
						</div>
					</div>
					</div>
					<div class="row" style="clear:both;">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">Son/Daughter/Wife  <span style="color:#F00">*</span></div>
							<div class=" col-xs-12 col-sm-8">
								<select class="form-control" name="relationtype" id="relationtype">
								<option value="0">Select Please</option>
								<option>Son Of</option>
								<option>Daughter Of</option>
								<option>Wife Of</option>
							</select>
							<div class="text-danger" id="relationtype_error" style="display:none;"></div>
							</div>
				   </div><!--this field are added change max lenght-->
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
						<div class="col-xs-12 col-sm-12 input_sundaughter">
							<input type="text" autocomplete="off" class="form-control" maxlength="30" name="relationtypename" id="relationtypename" />
							<div class="text-danger" id="relationtypename_error" style="display:none;"></div>
						</div>
					</div>
				
					</div>                                     
					<div class="row">
							<div class="col-xs-12  col-sm-12" style="padding-top:20px;">
							<div class="col-xs-12 col-sm-2">Address (Street)  <span style="color:#F00">*</span> :</div>
							<div class="col-xs-12 col-sm-10">
								<textarea style="width:100%;" rows="3" cols="30" maxlength="150" name="area" id="reg_street"> </textarea>
								<div class="text-danger" id="reg_street_error" style="display:none;"></div>
							</div>
						</div>
					</div>
					
					<div class="row">
						 <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">City/Village <span style="color:#F00">*</span>:</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" autocomplete="off" class="form-control" name="city" id="reg_city" maxlength="20">
								<div class="text-danger" id="reg_city_error" style="display:none;"></div>
							</div>
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">Post <span style="color:#F00">*</span>:</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" autocomplete="off" class="form-control" name="post" id="reg_post" maxlength="20">
								<div class="text-danger" id="reg_post_error" style="display:none;"></div>
							</div>
					</div> <!--this field are added change max lenght-->
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">Pincode :</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" autocomplete="off" class="form-control" name="pin" id="reg_pin" maxlength="6">
								<div class="text-danger" id="reg_pin_error" style="display:none;"></div>
							</div>
					</div>
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">State <span style="color:#F00">*</span>:</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<select class="form-control" name="state" id="add_state">
									<option value="0">Select Please</option>
									<option>Andhra Pradesh (AP)</option>
									<option>Arunachal Pradesh (AR)</option>
									<option>Assam (AS)</option>
									<option>Bihar (BR)</option>
									<option>Chhattisgarh (CG)</option>
									<option>Goa (GA)</option>
									<option>Gujarat (GJ)</option>
									<option>Haryana (HR)</option>
									<option>Himachal Pradesh (HP)</option>
									<option>Jammu and Kashmir (JK)</option>
									<option>Jharkhand (JH)</option>
									<option>Karnataka (KA)</option>
									<option>Kerala (KL)</option>
									<option>Madhya Pradesh (MP)</option>
									<option>Maharashtra (MH)</option>
									<option>Manipur (MN)</option>
									<option>Meghalaya (ML)</option>
									<option>Mizoram (MZ)</option>
									<option>Nagaland (NL)</option>
									<option>Odisha(OD)</option>
									<option>Punjab (PB)</option>
									<option>Rajasthan (RJ)</option>
									<option>Sikkim (SK)</option>
									<option>Tamil Nadu (TN)</option>
									<option>Tripura (TR)</option>
									<option>Telangana (TS)</option>
									<option>Uttar Pradesh (UP)</option>
									<option>Uttarakhand (UK)</option>
									<option>West Bengal (WB)</option>
								</select>
								<div class="text-danger" id="add_state_error" style="display:none;"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">District <span style="color:#F00">*</span>:</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" autocomplete="off" class="form-control" name="district" maxlength="30" id="add_district">
								<div class="text-danger" id="add_district_error" style="display:none;"></div>
							</div>
						</div>
					
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">Tehsil <span style="color:#F00">*</span>:</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" autocomplete="off" class="form-control" name="tehsil" id="add_tehsil" maxlength="20">
								<div class="text-danger" id="add_tehsil_error" style="display:none;"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">Photo Id Type
								<span style="color:#F00">*</span> :
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<select class="form-control" name="photoidtype" id="photoidtype">
									<option value="0">Select Please</option>
									<option>Adhaar</option>
									<option>PAN card</option>
									<option>Ration card</option>
									<option>Driving licence</option>
									<option>VoterID</option>
									<option>Passport</option>
								</select>
								<div class="text-danger" id="photoidtype_error" style="display:none;"></div>
							</div>
						</div>
						
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">Photo ID Number
								<span style="color:#F00">*</span> :
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" autocomplete="off" class="form-control" name="idnumber" id="idnumber" maxlength="16">
								<div class="text-danger" id="idnumber_error" style="display:none;"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								Mobile No. :
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" autocomplete="off" class="form-control" name="mobile" id="reg_mobile" maxlength="10">
								<div class="text-danger" id="reg_mobile_error" style="display:none;"></div>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								Email ID:
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" autocomplete="off" class="form-control" name="email" id="reg_email" maxlength="50">
								<div class="text-danger" id="reg_email_error" style="display:none;"></div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 col-sm-12" style="padding-top:20px;">
							<div class="col-xs-12 col-sm-5 col-md-3">Registration Acknowledgement:</div>
							<div class="col-xs-12 col-sm-7 ">
								<input type="checkbox" id="GetSMS" name="GetAcknowledge_sms" id="GetAcknowledge" value="SMS">&nbsp;&nbsp; Get SMS &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="checkbox" id="GetEmail" name="GetAcknowledge_email" id="GetAcknowledge" value="EMAIL"> &nbsp;&nbsp; Get Email
							</div>
						</div>
					</div>
							
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								Account Holder Name(As per bank details) <span style="color:#F00">*</span>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" autocomplete="off" class="form-control" name="fpcBankAccountName" maxlength="50" id="fpcBankAccountName">
								<div class="text-danger" id="fpcBankAccountName_error" style="display:none;"></div>
							</div>
						</div><!--this field are added change max lenght-->
					
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								Bank Name <span style="color:#F00">*</span> :
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" autocomplete="off" class="form-control" name="fpcBank" maxlength="50" id="fpcBank">
								<div class="text-danger" id="fpcBank_error" style="display:none;"></div>
							</div>
						</div><!--this field are added change max lenght-->
					</div>
					<div class="row">
						   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								Bank Account No <span style="color:#F00">*</span> :
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="password" autocomplete="off" class="form-control" name="fpcBankAccount" id="fpcBankAccount" maxlength="16" oncopy="return false" onpaste="return false">
								<div class="text-danger" id="fpcBankAccount_error" style="display:none;"></div>
							</div>
						</div><!--this field are added change max lenght-->
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								IFSC Code <span style="color:#F00">*</span> :
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="password" autocomplete="off" class="form-control" name="fpcIfsc" id="fpcIfsc" maxlength="11" oncopy="return false" onpaste="return false">
								<div class="text-danger" id="fpcIfsc_error" style="display:none;"></div>
							</div>
						</div><!--this field are added change max lenght-->
					</div>
					<div class="row">
						  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							   Confirm Account No<span style="color:#F00">*</span> 
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" autocomplete="off" class="form-control" name="typeagainaccount" id="typeagainaccount" maxlength="16" oncopy="return false" onpaste="return false">
								<div class="text-danger" id="typeagainaccount_error" style="display:none;"></div>
							</div>
						</div> <!--this field are added change max lenght-->
					
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="padding-top:20px;">
							<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
								Confirm IFSC Code <span style="color:#F00">*</span> 
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
								<input type="text" autocomplete="off" class="form-control" name="typeagainifsc" id="typeagainifsc" maxlength="11" oncopy="return false" onpaste="return false">
								<div class="text-danger" id="typeagainifsc_error" style="display:none;"></div>
							</div>
					</div><!--this field are added change max lenght-->
					</div>
					<div class="row">
						<div class="col-xs-12  col-sm-12" style="padding-top:20px;">
							<div class="col-xs-12 col-sm-5">
							   Upload Copy Of Passbook/Cancelled Check in Support :
							</div>
							<div class="col-xs-12 col-sm-6 btn-upload">
								<div class="fileUpload btn">
									<input id="uploadBtn_passbook" type="file" name="userFiles">
								</div>
								
							</div>
						</div>
						<div class="col-xs-12  col-sm-12" style="padding-top:20px;">
							<div class="col-xs-12 col-sm-5">
							   Upload One Scan Copy Of Id Proof :
							</div>
							<div class="col-xs-12 col-sm-6 btn-upload">
								<div class="fileUpload btn ">
									<input id="uploadBtn_proof" class="upload" name="idproof" type="file" />
								</div>
								<img class="preview_img" src="#" alt="your Image" id="idProofImage">
							</div>
						</div>
					</div>
					<div class="clearfix"></div>
					<div style="width:100%; margin:10px auto; border-top:1px solid #eeeeee;"></div>
					<div style="width:180px; margin:10px auto;float:right;">
						<input type="hidden" name="pageName" value="/home/index.html">
						<input type="hidden" name="currentPageName" value="/home/other_register.html">
						<div style="width:90px; float:left;">
							<button id="enam_registration" type="button" class="btn pull-right btn-primary">Submit</button>
						</div>
						<div style="width:90px; float:left;">
							<button type="reset" id="registration_reset" class="btn btn-default pull-right btn-space">Cancel</button>
						</div>
					</div>
				</form>
		<!------------------------- end changes -------------------->			
				</div>
			</div>
	</head>
</html>
<!----------------------------------------------------------------------------------------------------------------------------------->
<script> 
 var baseUrl = $('#base_url').val();
 
	$(document).on('click','#enam_registration',function(){
		var formvalid = true;
		if($('#regtype').val() == 0){
			$('#regtype_error').html('Please select Registration type.').css('display','block');
			formvalid = false;
		}
		else{
			$('#regtype_error').css('display','none');
			formvalid = true;
		}
		
		if($('#regstate').val() == 0){
			$('#regstate_error').html('Please select State.').css('display','block');
			formvalid = false;
		}
		else{
			$('#regstate_error').css('display','none');
			formvalid = true;
		}
		
		if($('#reg_with').val() == 0){
			$('#reg_with_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#reg_with_error').css('display','none');
			formvalid = true;
		}
		
		if($('#nametitle').val() == 0){
			$('#nametitle_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#nametitle_error').css('display','none');
			formvalid = true;
		}
		
		if($('#reg_fname').val() == ''){
			$('#reg_fname_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#reg_fname_error').css('display','none');
			formvalid = true;
		}
		
		if($('#reg_lname').val() == ''){
			$('#reg_lname_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#reg_lname_error').css('display','none');
			formvalid = true;
		}
		
		if($('#reg_gender').val() == 0){
			$('#reg_gender_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#reg_gender_error').css('display','none');
			formvalid = true;
		}
		
		if($('#reg_gender').val() == 0){
			$('#reg_gender_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#reg_gender_error').css('display','none');
			formvalid = true;
		}
		
		if($('#reg_dob').val() == ''){
			$('#reg_dob_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#reg_dob_error').css('display','none');
			formvalid = true;
		}
			
		if($('#relationtype').val() == 0){
			$('#relationtype_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#relationtype_error').css('display','none');
			formvalid = true;
		}
		
		if($('#relationtype').val() == ''){
			$('#relationtype_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#relationtype_error').css('display','none');
			formvalid = true;
		}
		
		if($('#reg_city').val() == ''){
			$('#reg_city_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#reg_city_error').css('display','none');
			formvalid = true;
		}
		
		if($('#reg_post').val() == ''){
			$('#reg_post_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#reg_post_error').css('display','none');
			formvalid = true;
		}
		
		if($('#add_state').val() == 0){
			$('#add_state_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#add_state_error').css('display','none');
			formvalid = true;
		}
		
		if($('#add_district').val() == ''){
			$('#add_district_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#add_district_error').css('display','none');
			formvalid = true;
		}
		
		if($('#add_tehsil').val() == ''){
			$('#add_tehsil_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#add_tehsil_error').css('display','none');
			formvalid = true;
		}
		if($('#photoidtype').val() == 0){
			$('#photoidtype_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#photoidtype_error').css('display','none');
			formvalid = true;
		}
		
		if($('#idnumber').val() == 0){
			$('#idnumber_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#idnumber_error').css('display','none');
			formvalid = true;
		}
		
		if($('#fpcBankAccountName').val() == ''){
			$('#fpcBankAccountName_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#fpcBankAccountName_error').css('display','none');
			formvalid = true;
		}
		
		if($('#fpcBank').val() == ''){
			$('#fpcBank_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#fpcBank_error').css('display','none');
			formvalid = true;
		}
		
		if($('#fpcBankAccount').val() == ''){
			$('#fpcBankAccount_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#fpcBankAccount_error').css('display','none');
			formvalid = true;
		}
		
		if($('#fpcIfsc').val() == ''){
			$('#fpcIfsc_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#fpcIfsc_error').css('display','none');
			formvalid = true;
		}
		
		if($('#typeagainaccount').val() == ''){
			$('#typeagainaccount_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#typeagainaccount_error').css('display','none');
			formvalid = true;
		}
		
		if($('#typeagainifsc').val() == ''){
			$('#typeagainifsc_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#typeagainifsc_error').css('display','none');
			formvalid = true;
		}
		
		if($('#reg_street').val() == ''){
			$('#reg_street_error').html('Please fill this field.').css('display','block');
			formvalid = false;
		}
		else{
			$('#reg_street_error').css('display','none');
			formvalid = true;
		}
		
		if(formvalid){
			$('#registration_form').ajaxForm({
					dataType : 'json',
					beforeSubmit:function(e){},
					success:function(response){
					  if(response.status == 200){
					  }
					  else{
					  }
					}
			  }).submit();
		}
	});
	
	
	function form_check(){	
		var baseUrl = $('#base_url').val();
		var reg_level = $('input[name=registerlevel]:checked').val();
		var regtype = $('#regtype').val();
		//var reg_cat = $('#regcat').val();
		var regstate = $('#regstate').val();
		//var reg_with = $('#reg_with').val();
		
		var nametitle = $('#nametitle').val();
		var reg_fname = $('#reg_fname').val();
		var reg_mname = $('#reg_mname').val();
		var reg_lname = $('#reg_lname').val();
		var reg_gender = $('#reg_gender').val();
		var reg_dob = $('#reg_dob').val();
		var relationtype = $('#relationtype').val();
		var reg_street = $('#reg_street').val();
		var reg_city = $('#reg_city').val();
		var reg_post = $('#reg_post').val();
		var reg_pin = $('#reg_pin').val();
		var add_state = $('#add_state').val();
		var add_district = $('#add_district').val();
		var add_tehsil = $('#add_tehsil').val();
		var photoidtype = $('#photoidtype').val();
		var idnumber = $('#idnumber').val();
		var reg_mobile = $('#reg_mobile').val();
		var reg_email = $('#reg_email').val();
		var GetAcknowledge_sms  = $('input[name=GetAcknowledge_sms]:checked').val();
		var GetAcknowledge_email = $('input[name=GetAcknowledge_email]:checked').val();
		var fpcBankAccountName = $('#fpcBankAccountName').val();
		var fpcBankAccount = $('#fpcBankAccount').val();
	}
	
	
	$(document).on('click','.reg_level',function(){
		var x = $(this).val();
		if(x == 'apmc'){
			$('#apmc_name').css('display','block');
		}
		else{
			$('#apmc_name').css('display','none');
		}
	});
	
	$(document).on('change','#regtype',function(){
		var x = $(this).val();
		if(x == 'seller'){
			$('.mydisplayboxfpcF').css('display','block');
			$('.mydisplayboxbuy').css('display','none');
			$('.mydisplayboxfpcSP').css('display','none');
		}
		else if(x == 'buyer'){
			$('.mydisplayboxbuy').css('display','block');
			$('.mydisplayboxfpcF	').css('display','none');
			$('.mydisplayboxfpcSP').css('display','none');
		}
		else if(x == 'ser_pro'){
			$('.mydisplayboxfpcSP').css('display','block');
			$('.mydisplayboxfpcF').css('display','none');
			$('.mydisplayboxbuy').css('display','none');
		}
		else{
			$('.mydisplayboxfpcSP').css('display','none');
			$('.mydisplayboxfpcF').css('display','none');
			$('.mydisplayboxbuy').css('display','none');
		}
	});
	
	$(document).on('change','#regstate',function(){
		var str = $(this).val();
		var ids = str.split("-");
		
		$.ajax({
			type : 'POST',
			url : baseUrl+'Ajax_ctrl/apmc_list',
			dataType : 'json',
			data : {
				'state_id' : ids[1]
			},
			success : function (response){
				if(response.status == 200){
					var x = '<option value="-select-">-Select-</option>';
					$.each(response.data,function(key,value){
						x = x + '<option value="'+ value.apmc_id +'-'+ value.apmc_name +'">'+ value.apmc_name +'</option>';
					});
					$('#reg_with').html(x);
				}
			}
		});
	});
 </script>