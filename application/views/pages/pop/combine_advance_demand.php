<style type="text/css">
	#loader { 
    	display: none;
	 	position: fixed;
	  	top: 0;
	  	left: 0;
	  	right: 0;
	  	bottom: 0;
	  	width: 100%;
	  	background: rgba(0,0,0,0.75) url(<?php echo base_url();?>assest/images/gif-load.gif) no-repeat center center;
	  	z-index: 10000;
	}

	.daysfilter{
		width: 100px;
	}
</style>
<?php 
if(isset($param_state) && isset($param_apmc)){ ?>
  	<input type="hidden" id="state_id_param" value="<?php echo $param_state; ?>">
  	<input type="hidden" id="apmc_id_param" value="<?php echo $param_apmc; ?>">
<?php }?>

<section class="title-header-bg-apmc"></section>
<section class="container-fuild content-section emandi-sec" >
	<div class="container">
		<div class="" style="margin-top:10px;">
			<div class="col-md-12 bc-nav">
				<a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
				<?php echo $this->lang_file->heading_fetch('advance_demand');?>
			</div>
			<?php date_default_timezone_set("Asia/Kolkata");
				$date = date("Y-m-d");
			?>

			<div class="col-md-12" style="padding:0px;"><h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('advance_demand');?></span></h3></div>
			<div class="col-sm-12 well e-trade-detail-box" >
				<input type="hidden" id="previous_date" value="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>">
				<input type="hidden" id="current_date" value="<?php echo $date;?>">
				<div class="col-md-2 emandi-select e-trade-inputs1" style="padding-left: 9px;width: 175px;">
					<b><?php echo $this->lang_file->heading_fetch('min_max_from_date');?></b><input type="date" class="form-control" name="fromDate" id="fromDate" value="<?php echo date("Y-m-d")?>" min="<?php echo date("Y-m-d"); ?>">
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs1" style="width: 175px;">
					<b><?php echo $this->lang_file->heading_fetch('min_max_to_date');?></b> 
					<input type="date" class="form-control" name="toDate" id="toDate" value="<?php echo date("Y-m-d")?>" min="<?php echo date("Y-m-d"); ?>">
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs1" style="width: 175px;">
					<b><?php echo $this->lang_file->heading_fetch('demd_platform');?></b> 
					<select class="form-control" id="platform_selection" name="platform_selection">
						<option value="">--All--</option>
						<option value="eNam"><?php echo $this->lang_file->heading_fetch('enam');?></option>
						<option value="pop"><?php echo $this->lang_file->heading_fetch('demd_pop');?></option>
					</select>
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs" style="width:200px;">
					<b><?php echo $this->lang_file->heading_fetch('min_max_state');?></b>
					<select class="form-control" id="demand_state" name="demand_state">
						<option value="">--All--</option>
					</select>
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs" id="district_div" style="width:200px;display: none;">
					<b>
						<span id="district_class"><?php echo $this->lang_file->heading_fetch('min_max_district');?></span>
						<span id="location_class"><?php echo $this->lang_file->heading_fetch('pop_location');?></span>
					</b>
					<select class="form-control" id="demand_district" name="demand_district">
						<option value="">--All--</option>
					</select>
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs" style="width: 200px;">
					<b><?php echo $this->lang_file->heading_fetch('min_max_commodity');?></b>
					<select class="form-control" id="demand_commo" name="demand_commo">
						<option value="">Select Commodity</option>
					</select>
				</div>
				<div style="padding-right: 0;" class="col-md-2 emandi-select e-trade-refresh-b">
					<input style="margin-top:21px;" class="btn btn-primary" type="button" value="Search" id="submitbtn">
				</div>
			</div>

			<br><br><br>
			<div class="row">
				<div class="col-md-12" style="margin-top:15px;">
					<div class="pull-left"><b><?php echo $this->lang_file->heading_fetch('arrival_expect');?>:</b> <select class="form-control mandi-pagi daysfilter" name="arr_dropdown" id="arr_dropdown"></select></div>

					<div class="pull-right"><b><?php echo $this->lang_file->heading_fetch('min-max-page');?>:</b> <select class="form-control mandi-pagi" name="min_max_no_of_list" id="min_max_no_of_list"></select></div>
				</div>
				<div class="col-md-12 table-responsive">	
					<table class="table table-striped table-bordered" id="advanceDemand_table" style="table-layout: fixed;">
						<thead>
							<tr>
								<th style="width: 50px;">Sr. No.</th>
								<th style="width: 137px;"><?php echo $this->lang_file->heading_fetch('min_max_state');?></th>
								<th style=""><?php echo $this->lang_file->heading_fetch('min_max_district');?> / <?php echo $this->lang_file->heading_fetch('pop_location');?></th>
								<th style=""><?php echo $this->lang_file->heading_fetch('demd_platform');?>/<?php echo $this->lang_file->heading_fetch('pop_apmc');?></th>
								<th style="width:180px;"><?php echo $this->lang_file->heading_fetch('form_buyer');?></th>
								<th style="width:79px;"><?php echo $this->lang_file->heading_fetch('arr_date');?></th>
								<th style="width:92px;"><?php echo $this->lang_file->heading_fetch('pop_commodity');?></th>
								<th style="width:59px;"><?php echo $this->lang_file->heading_fetch('demd_quan');?></th>
								<th style="width:66px;"><?php echo $this->lang_file->heading_fetch('demd_uom');?></th>
								<th style="width:81px;"><?php echo $this->lang_file->heading_fetch('enam');?>/<?php echo $this->lang_file->heading_fetch('demd_pop');?></th>
							</tr>
						</thead>

						<tbody class="tbody" id="demand_data">
										
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<?php 
	$c = 1;
	$url_array ='';
	while($this->uri->segment($c) != ''){
		$url_array.= $this->uri->segment($c).'/';
		$c = $c + 1;
	}
	$url_array = strtolower(rtrim($url_array,"/ ")); 
?>

<div id="loader"></div>

<script type="text/javascript">
	var baseUrl = $('#base_url').val();
	var start = 0;
	var limit = 10;
	var data_array = [];
	var spinner = $('#loader');

	$.ajax({
		type: 'post',
		url: baseUrl+'Ajax_ctrl/menu_activate/<?php echo $url_array;?>',
		dataType: "json",
		data:{},
		beforeSend: function(){},
		complete: function(){},
		success: function (response){
			if(response.status == 200){
				if (typeof response.data[0].id !== 'undefined') {
					$('#menuid_'+response.data[0].id).addClass('active');	
				}
				if (typeof response.data[0].p_id !== 'undefined') {
					$('#menuid_'+response.data[0].p_id).addClass('active');
				}
			    $('#bredcrum').html(response.bredcrum);	
			}
	        else{
				$('#bredcrum').html(response.bredcrum);	
			}
		}
	});

	$('#backBtn').click(function(){
		parent.history.back();
	});

	getMonthAllDays();
	let startDate = document.getElementById('fromDate').value;
	let endDate = document.getElementById('toDate').value;		
	getState(startDate,endDate);
	getCommodity(startDate,endDate,null);

	// on state change
	$('#demand_state').change(function(){
		let startDate = document.getElementById('fromDate').value;
		let endDate = document.getElementById('toDate').value;
		let platformSeletionVal = $('#platform_selection').val();
		let stateName =  $("#demand_state option:selected").text();
		let stateId = $('#demand_state').val();
		let state = stateName === '--All--' ? '' : stateName;
		let distName = $('#demand_district option:selected').text();
		let distId = $('#demand_district').val();

		if(platformSeletionVal === 'eNam'){
			getEnamDistrict(startDate, endDate, stateId);
			getEnamCommodity(stateId, distId, startDate, endDate);
		}else if(platformSeletionVal === 'pop'){
			getDistrictForPop(startDate, endDate, stateName);
			getCommodity(startDate,endDate,state);
		}
	});

	// on Dates changes
	$(document).on('change','#fromDate,#toDate',function(){
		let startDate = document.getElementById('fromDate').value;
		let endDate = document.getElementById('toDate').value;
		let stateId = $('#demand_state').val();
		let stateName =  $("#demand_state option:selected").text();
		let distId = $('#demand_district').val();
		let distName = $('#demand_district option:selected').text();
		let platformSeletionVal = $('#platform_selection').val();

		let state = stateName === '--All--' ? '' : stateName;
		let district = distName === '--All--' ? '' : distName;

		if(endDate !== '' && startDate !== ''){
			if(startDate > endDate){
				alert('Please select To Date is greater than From Date');
				$('#toDate').val('');
			}
		}

		if(platformSeletionVal === 'eNam'){
			getEnamStates(startDate, endDate);
		}else if(platformSeletionVal === 'pop'){
			getPopStates(startDate, endDate);
		}else{
			getState(startDate,endDate);
		}

		getCommodity(startDate,endDate,state);
	});

	//On Submit button 
	$(document).on('click','#submitbtn',function(){
		spinner.show();
		$('#arr_dropdown').val('');
		let fromDate = $("#fromDate").val();
		let toDate = $("#toDate").val();
		let stateName =  $("#demand_state option:selected" ).text();
		let commodityName =  $("#demand_commo option:selected" ).text();
		let distName = $('#demand_district option:selected').text();
		let platformSeletionVal = $('#platform_selection').val();

		let sName = stateName === '--All--' ? '' : stateName;
		let comm = commodityName === 'Select Commodity' ? '' : commodityName;
		let platSelect = platformSeletionVal === '' ? '' : platformSeletionVal;

		getAllAdvDemandData(fromDate,toDate,sName,comm,platformSeletionVal);
	});

	//Pagination pages change
	$(document).on('change','#min_max_no_of_list',function(){
		var value = $(this).val();
		pagination(value);
	});

	// No. of days change
	$(document).on('change','#arr_dropdown',function(){
		let checkDay = $(this).val();
		spinner.show();
		if(checkDay!=''){
			var t = new Date();
			var dd = String(t.getDate()).padStart(2, '0');
		    var mm = String(t.getMonth() + 1).padStart(2, '0'); //January is 0!
		    var yyyy = t.getFullYear();
		    var todayDate = yyyy + '-' + mm + '-' + dd;

		    t.setDate(t.getDate() + parseInt(checkDay)); 
		    var month = String(t.getMonth() + 1).padStart(2, '0');
		    var date = String(t.getDate()).padStart(2, '0');
		    var afterDaysDate = `${t.getFullYear()}-${month}-${date}`;

		    let demandCommodity = $("#demand_commo option:selected").text();
			let demandState = $("#demand_state option:selected").text();
			let platformSeletionVal = $('#platform_selection').val();

			$('#fromDate').val(todayDate);
			$('#toDate').val(afterDaysDate);

			let comm = demandCommodity === 'Select Commodity' ? '' : demandCommodity;
			let sName = demandState === '--All--' ? '' : demandState;

			if(platformSeletionVal === 'eNam'){
				getEnamStates(todayDate,afterDaysDate);
			}else if(platformSeletionVal === 'pop'){
				getPopStates(todayDate,afterDaysDate);
				getCommodity(todayDate,afterDaysDate,sName)
			}else{
				getState(todayDate,afterDaysDate);
				getCommodity(todayDate,afterDaysDate,sName);
			}

			getAllAdvDemandData(todayDate,afterDaysDate,comm,sName,platformSeletionVal);
		}else{
			spinner.hide();
		}
	});


	// When Platforms dropdown change
	$(document).on('change','#platform_selection', function(){
		let selectedVal = $(this).val();
		let stateId = $('#demand_state').val();
		let sName = $('#demand_state option:selected').text();
		let distId = $('#demand_district').val();
		let distName = $('#demand_district option:selected').text();
		let fromDate = $('#fromDate').val();
		let toDate = $('#toDate').val();

		if(selectedVal === 'pop'){
			$('#district_div').css('display','block');
			$('#location_class').css('display','block');
			$('#district_class').css('display','none');
			$('#demand_state').val('');
			$('#demand_commo').val('');
			getPopStates(fromDate, toDate);
			getPopCommodity(fromDate, toDate);
			$('#demand_district').val('');
		}
		else if(selectedVal === 'eNam'){
			$('#district_div').css('display','block');
			$('#district_class').css('display','block');
			$('#location_class').css('display','none');
			$('#demand_state').val('');
			$('#demand_district').val('');
			$('#demand_commo').val('');
			getEnamStates(fromDate, toDate);
			getEnamCommodity(stateId, distId, fromDate, toDate);
		}else{
			$('#district_div').css('display','none');
			$('#demand_state').html('--All--');
			$('#demand_district').html('--All--');
			$('#demand_commo').html('Select Commodity');
		}
	});

	$(document).on('change','#demand_district', function(){
		let stateId = $('#demand_state').val();
		let sName = $('#demand_state option:selected').text();
		let distId = $(this).val();
		let distName = $('#demand_district option:selected').text();
		let platformSeletionVal = $('#platform_selection').val();
		let fromDate = $('#fromDate').val();
		let toDate = $('#toDate').val();

		if(platformSeletionVal === 'eNam'){
			getEnamCommodity(stateId, distId, fromDate, toDate);
		}else if(platformSeletionVal === 'pop'){

		}
	});

	function getState(startDate, endDate){
	
		var settings = {
		  	"url": "https://enam.gov.in/pop/rest/queryapi/COMBINEDEMANDSTATE",
		  	"method": "POST",
		  	"timeout": 0,
		  	"headers": {
		    	"Content-Type": "application/json"
		  	},
		  	"data": JSON.stringify({
		    	"param1": `${startDate}`,
		    	"param2": `${endDate}`
		  	}),
		};

		$.ajax(settings).done(function (response) {
		  	if(response.status == "Success"){
	 			let x = '<option value="">--All--</option>';
	 			for(let data of response.data){
	 				x+=`<option value=${data.trdr_state_name}>${data.trdr_state_name}</option>`;
	 			}
	 			$('#demand_state').html(x)
	 		}else{
	 			//spinner.hide();
	 		}
		});
	}

	function getCommodity(startDate, endDate,stateName){
		
		var settings = {
		  	"url": "https://enam.gov.in/pop/rest/queryapi/COMBINEDEMANDCOMM",
		  	"method": "POST",
		  	"timeout": 0,
		  	"headers": {
		    	"Content-Type": "application/json"
		  	},
		  	"data": JSON.stringify({
		    	"param1": `${startDate}`,
		    	"param2": `${endDate}`,
		    	"param3": `${stateName}`,
		  	}),
		};

		$.ajax(settings).done(function (response) {
		  	if(response.status == "Success"){
				let x = '<option value="">Select Commodity</option>';
	 			for(let data of response.data){
	 				x+=`<option value=${data.commodity_variety_name}>${data.commodity_variety_name}</option>`
	 			}
	 			$('#demand_commo').html(x);
	 		}else{
	 			//spinner.hide();
	 		}
		});
	}


	// API Call's for eNam

	function getEnamStates(fromDate, toDate){
		var settings = {
		  	"url": "https://enam.gov.in/NamWebSrv/rest/AdvancedDemandTrader/getAdvDemandState",
		  	"method": "POST",
		  	"timeout": 0,
		  	"headers": {
		    	"Content-Type": "application/x-www-form-urlencoded"
		  	},
		  	"data": {
		    	"orgId": "1",
		    	"fromDate": `${fromDate}`,
		    	"toDate": `${toDate}`
		  	}
		};

		$.ajax(settings).done(function (response) {
		  	let x = '<option>--All--</option>';
		  	if(response.status === 'S'){
		  		for(let data of response.listData){
		  			x += `<option value=${data.traderStateId}>${data.traderStateName}</option>`;
		  		}
		  		$('#demand_state').html(x);
		  	}else if(response.status === 'F'){
		  		x +=`<option>No states available</option>`;
		  		$('#demand_state').html(x);
		  	}else{
		  		
		  	}
		});
	}

	//Function for eNam Districts
	function getEnamDistrict(startDate, endDate, stateId){
		var settings = {
		  	"url": "https://enam.gov.in/NamWebSrv/rest/AdvancedDemandTrader/getAdvDemandDistrict",
		 	"method": "POST",
		 	"timeout": 0,
		  	"headers": {
		    	"Content-Type": "application/x-www-form-urlencoded"
		  	},
		  	"data": {
			    "orgId": "1",
			    "stateId":`${stateId}`,
			    "fromDate": `${startDate}`,
			    "toDate": `${endDate}`
		  	}
		};

		$.ajax(settings).done(function (response) {
		  	let x = "<option val=''>--All--</option>";
		  	for(let data of response.listData){
		  		x += `<option value=${data.traderDistrictId}>${data.traderDistrictName}</option>`;
		  	}
		  	$('#demand_district').html(x);
		});
	}

	function getEnamCommodity(stateId, distId, fromDate, toDate){
		var settings = {
		  	"url": "https://enam.gov.in/NamWebSrv/rest/AdvancedDemandTrader/getAdvDemandCommodity",
		  	"method": "POST",
		  	"timeout": 0,
		  	"headers": {
		    	"Content-Type": "application/x-www-form-urlencoded"
		  	},
		  	"data": {
		    	"orgId": "1",
		    	"stateId": `${stateId}`,
		    	"districtId": `${distId}`,
		    	"apmcId": "",
		    	"fromDate": `${fromDate}`,
		    	"toDate": `${toDate}`
		  	}
		};

		$.ajax(settings).done(function (response) {
		  	let x = '<option value="">Select Commodity</option>';
		  	if(response.status === 'S'){
			  	for(let data of response.listData){
			  		x += `<option value=${data.commodityVarietyId}>${data.commodityVarietyName}</option>`;
			  	}
			  	$('#demand_commo').html(x);
			}else{
				$('#demand_commo').val('');
			}
		});
	}


	// Function for POP 

	function getPopStates(startDate, endDate){
		var settings = {
		  	"url": "https://enam.gov.in/pop/rest/queryapi/DEMANDSTATELOV",
		  	"method": "POST",
		  	"timeout": 0,
		  	"headers": {
		    	"Content-Type": "application/json"
	  		},
	  		"data": JSON.stringify({
			    "limit": 0,
			    "page": 0,
			    "param1": `${startDate}`,
			    "param10": "",
			    "param2": `${endDate}`,
			    "param3": "",
			    "param4": "",
			    "param5": "",
			    "param6": "",
			    "param7": "",
			    "param8": "",
			    "param9": "",
			    "tokenopr": "",
			    "tokenorg": ""
	  		}),
		};

		$.ajax(settings).done(function (response) {
		  	let x = '<option value="">--All--</option>';
		  	for(let data of response.data){
		  		x += `<option value=${data.state}>${data.state}</option>`;
		  	}
		  	$('#demand_state').html(x);
		});
	}

	function getDistrictForPop(startDate, endDate, sName){
		var settings = {
		  	"url": "https://enam.gov.in/pop/rest/queryapi/DEMANDDISTLOV",
		  	"method": "POST",
		  	"timeout": 0,
		  	"headers": {
		    	"Content-Type": "application/json"
	  		},
	  		"data": JSON.stringify({
			    "limit": 0,
			    "page": 0,
			    "param1": `${startDate}`,
			    "param10": "",
			    "param2": `${endDate}`,
			    "param3": `${sName}`,  //state id : optional
			    "param4": "",
			    "param5": "",
			    "param6": "",
			    "param7": "",
			    "param8": "",
			    "param9": "",
			    "tokenopr": "",
			    "tokenorg": ""
	  		}),
		};

		$.ajax(settings).done(function (response) {
		  	if(response.status === 'Success'){
		  		let x = '<option val="">--All--</option>';
		  		for(let data of response.data){
		  			x+= `<option val=${data.trdr_district_name}>${data.trdr_district_name}</option>`;
		  			$('#demand_district').html(x);
		  		}
		  	}else{

		  	}
		});
	}

	function getPopCommodity(startDate, endDate){
		var settings = {
		  	"url": "https://enam.gov.in/pop/rest/queryapi/DEMANDCOMMOLOV",
		  	"method": "POST",
		  	"timeout": 0,
		  	"headers": {
		    	"Content-Type": "application/json"
	  		},
	  		"data": JSON.stringify({
			    "limit": 0,
			    "page": 0,
			    "param1": `${startDate}`,
			    "param10": "",
			    "param2": `${endDate}`,
			    "param3": "",
			    "param4": "",
			    "param5": "",
			    "param6": "",
			    "param7": "",
			    "param8": "",
			    "param9": "",
			    "tokenopr": "",
			    "tokenorg": ""
	  		}),
		};

		$.ajax(settings).done(function (response) {
		  	if(response.status === 'Success'){
		  		let x = '<option val="">Select Commodity</option>';
		  		for(let data of response.data){
		  			x+= `<option val=${data.commodity}>${data.commodity}</option>`;
		  			$('#demand_commo').html(x);
		  		}
		  	}
		});
	}


	// For getting all data
	function getAllAdvDemandData(fromDate,toDate,stateName,commodityName,platSelect){
		var settings = {
		  	"url": "https://enam.gov.in/pop/rest/get_combine_demand_data",
		  	"method": "POST",
		  	"timeout": 0,
		  	"headers": {
		    	"Authorization": "Bearer d0obq7uvqi6i62kb1rc6tcetnc8jnbaq",
		    	"Content-Type": "application/json"
		  	},
		  	"data": JSON.stringify({
		  		"flag": `${platSelect}`, //optional
		    	"fromDate": `${fromDate}`,
		    	"toDate": `${toDate}`,
		    	"state": `${stateName}`,
		    	"district" : "", // Optional
		    	"commodityid": `${commodityName}`
		  	}),
		};

		$.ajax(settings).done(function (response) {
			let resData = response;
			let i=1, tableData = '';
			if(Object.keys(resData.data).length > 0){
				spinner.hide();
				data_array = [];
	    		$.each(resData.data.popbuyerdemandmstlist,function(key,value){
	    			data_array.push(value);
	    		});
	    		var array_length = data_array.length;
	    		var pages = parseInt(parseInt(array_length)/parseInt(limit));
	    		var y = '';
	    		for(var p = 0;p<= pages; p++){	
	         		y = y + '<option value="'+ p +'">'+ parseInt(parseInt(p)+1) +'</option>';
	    		}
	    		$('#min_max_no_of_list').html(y);
	    		pagination(start);
			}
			else{
				spinner.hide();
				$('#advanceDemand_table tbody').html('<tr><td colspan="11" style="text-align:center;">No record Found.</td></tr>');
				$('#demand_state').val('');
				$('#demand_district').val('');
				$('#demand_commo').val('');
				$('#platform_selection').val('');
			}
		});
	}

	function pagination(start){
		let platformSeletionVal = $('#platform_selection').val();
		var array_length = data_array.length;
		if(start != 0){
			slug = 1;
		}
		else{
			slug = 0;
		}
		var x = '';
		var k=1;
		for(var i = parseInt(parseInt(start*limit)+slug); i <= (parseInt(parseInt(parseInt(start)*10))+10); i++){
			// <td align="center" style="text-align:center;">${data_array[i].apmc}</td>
			if(i < array_length){
				x +=`<tr>
						<td align="center" style="text-align:center;">${k++}</td>
						<td align="center" style="text-align:center;">${data_array[i].state_name}</td>
						<td align="center" style="text-align:center;">${data_array[i].district_name}</td>

						${platformSeletionVal === 'eNam' || platformSeletionVal === ''  ? `<td align="center" style="text-align:center;">${data_array[i].apmc}</td>` : `<td align="center" style="text-align:center;">${data_array[i].platform_name}</td>`}

						<td align="center" style="text-align:center;">${data_array[i].buyer_name}</td>
						<td align="center" style="text-align:center;text-transform: capitalize">${data_array[i].expected_arrival_date}</td>
						<td align="center" style="text-align:center;">${data_array[i].commodity_variety}</td>
						<td align="center" style="text-align:center;">${data_array[i].commodity_quantity}</td>
						<td align="center" style="text-align:center;">${data_array[i].qty_uom}</td>
						
						${data_array[i].flag == 'mandi' ? '<td align="center" style="text-align:center;">e-NAM</td>' : '<td align="center" style="text-align:center;">PoP</td>'}
						
					</tr>`;  
			}
			else{
	    		break;
			}
		} 
		$('#advanceDemand_table tbody').html(x);
	}

	function getMonthAllDays(){
		var select = '<option value="">select days</option>';
		for (i=1;i<=30;i++){
		    select += '<option val=' + i + '>' + i + '</option>';
		}
		$('#arr_dropdown').html(select);
	}

</script>

