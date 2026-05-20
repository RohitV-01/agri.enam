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
<section class="container-fuild content-section emandi-sec">
	<div class="container">
		<div class="" style="margin-top:10px;">
			<div class="col-md-12 bc-nav">
				<a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
				<?php echo $this->lang_file->heading_fetch('advance_supply');?>
			</div>
			<?php date_default_timezone_set("Asia/Kolkata");
				$date = date("Y-m-d");
			?>

			<div class="col-md-12" style="padding:0px;"><h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('advance_supply');?></span></h3></div>
				<div class="col-sm-12 well e-trade-detail-box" >
				<input type="hidden" id="previous_date" value="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>">
				<input type="hidden" id="current_date" value="<?php echo $date;?>">
				<div class="col-md-2 emandi-select e-trade-inputs1" style="padding-left: 9px;">
					<b><?php echo $this->lang_file->heading_fetch('min_max_from_date');?></b><input type="date" class="form-control" name="fromDate" id="fromDate" value="<?php echo date("Y-m-d")?>" min="<?php echo date("Y-m-d"); ?>">
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs1">
					<b><?php echo $this->lang_file->heading_fetch('min_max_to_date');?></b> 
					<input type="date" class="form-control" name="toDate" id="toDate" value="<?php echo date("Y-m-d")?>" min="<?php echo date("Y-m-d"); ?>">
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs" style="padding-left:15px;">
					<b><?php echo $this->lang_file->heading_fetch('min_max_state');?></b>
					<select class="form-control" id="supply_state" name="supply_state">
						<option value="">--All--</option>
					</select>
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs">
					<b><?php echo $this->lang_file->heading_fetch('min_max_district');?></b>
					<select class="form-control" id="supply_district" name="supply_district">
						<option value="">--All--</option>
					</select>
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs">
					<b><?php echo $this->lang_file->heading_fetch('min_max_commodity');?></b>
					<select class="form-control" id="supply_commo" name="supply_commo">
						<option value="">Select Commodity</option>
					</select>
				</div>
				<div style="padding-right: 0;" class="col-md-2 emandi-select e-trade-refresh-b">
					<input style="margin-top:21px;" class="btn btn-primary" type="button" value="Search" id="refresh">
				</div>
			</div>
			<br><br>
			<div class="row">
				<div class="col-md-12" style="margin-top:15px;">
					<div class="pull-left"><b><?php echo $this->lang_file->heading_fetch('arrival_expect');?>:</b> <select class="form-control mandi-pagi daysfilter" name="arr_dropdown" id="arr_dropdown"></select></div>

					<div class="pull-right"><b><?php echo $this->lang_file->heading_fetch('min-max-page');?>:</b> <select class="form-control mandi-pagi" name="min_max_no_of_list" id="min_max_no_of_list"></select></div>
				</div>

				<div class="col-md-12 table-responsive" id="table_res">	
					<table class="table table-striped table-bordered" id="advanceSupplyTable">
						<thead>
							<tr>
								<th rowspan="2" style="text-align:center;padding-bottom: 19px">Sr. No.</th>
								<th rowspan="2" style="text-align:center;padding-bottom: 19px"><?php echo $this->lang_file->heading_fetch('min_max_state');?></th>
								<th rowspan="2" style="text-align:center;padding-bottom: 19px"><?php echo $this->lang_file->heading_fetch('min_max_district');?></th>
								<th rowspan="2" style="text-align:center;padding-bottom: 19px"><?php echo $this->lang_file->heading_fetch('form_seller');?></th>
								<th colspan="2" style="text-align:center;">Expected Supply Date</th>
								<th rowspan="2" style="text-align:center;padding-bottom: 19px"><?php echo $this->lang_file->heading_fetch('pop_commodity');?></th>
								<th rowspan="2" style="text-align:center;padding-bottom: 19px"><?php echo $this->lang_file->heading_fetch('demd_quan');?></th>
								<th rowspan="2" style="text-align:center;padding-bottom: 19px"><?php echo $this->lang_file->heading_fetch('demd_uom');?></th>
								<th rowspan="2" style="text-align:center;padding-bottom: 19px"><?php echo $this->lang_file->heading_fetch('enam');?> / <?php echo $this->lang_file->heading_fetch('demd_pop');?></th>
							</tr>
							<tr>
								<th><?php echo $this->lang_file->heading_fetch('min_max_from_date');?></th>
								<th><?php echo $this->lang_file->heading_fetch('min_max_to_date');?></th>
							</tr>
						</thead>

						<tbody class="tbody" id="all_data">
													
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
	getMonthAllDays();
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


	$(document).ready(function() {
		let startDate = document.getElementById('fromDate').value;
		let endDate = document.getElementById('toDate').value;	
	
		let supplyState = null;
		let supplyDistrict =null;	
		getStatesForSupply(startDate,endDate);
		getCommodity(startDate,endDate,supplyState,supplyDistrict)

		$('#backBtn').click(function(){
			parent.history.back();
		});

		$('#refresh').click(function(e){
			e.preventDefault();
			spinner.show();
			$('#arr_dropdown').val('');
			let startDate = document.getElementById('fromDate').value;
			let endDate = document.getElementById('toDate').value;
			let supplyCommodity = $("#supply_commo option:selected").text();
			let supplyState = $("#supply_state option:selected").text();
			let supplyDistrict =$("#supply_district option:selected").text();

			let comm = supplyCommodity === 'Select Commodity' ? '' : supplyCommodity;
			let sName = supplyState === '--All--' ? '' : supplyState;
			let dName = supplyDistrict === '--All--' ? '' : supplyDistrict;

			getAllSupplyData(startDate,endDate,comm,sName,dName);
		});

		$('#supply_state').change(function(){
			spinner.show();
			let startDate = document.getElementById('fromDate').value;
			let endDate = document.getElementById('toDate').value;
			let supplyState = $("#supply_state option:selected" ).text();

			let sName = supplyState === '--All--' ? '' : supplyState;
			getCommodity(startDate,endDate,sName,null);

			var settings = {
			  	"url": "https://enam.gov.in/pop/rest/queryapi/COMBINESUPPLYDIST",
			  	"method": "POST",
			  	"timeout": 0,
			  	"headers": {
			    	"Content-Type": "application/json"
			  	},
			  	"data": JSON.stringify({
			    	"param1" : `${startDate}`,
					"param2": `${endDate}`,
					"param3": `${supplyState}`
			  	}),
			};

			$.ajax(settings).done(function (response) {
			  	if(response.status == "Success"){
		 			if(response.data.length > 0){
		 				spinner.hide();
		 				let x = '<option value="">--All--</option>';
		 				for(let data of response.data){
		 					x+=`<option value=${data.frm_district_name}>${data.frm_district_name}</option>`
		 				}
		 				$('#supply_district').html(x)
		 			}else{
		 				spinner.hide();
		 			}
		 		}
			});
		});

		$('#supply_district').change(function(){
			spinner.show();
			let startDate = document.getElementById('fromDate').value;
			let endDate = document.getElementById('toDate').value;
			let supplyState = $("#supply_state option:selected" ).text();
			let supplyDist = $("#supply_district option:selected" ).text();

			let sName = supplyState === '--All--' ? '' : supplyState;
			let dName = supplyDist === '--All--' ? '' : supplyDist;
			getCommodity(startDate,endDate,sName,dName); 
		});

		$(document).on('change','#fromDate,#toDate',function(){
			spinner.show();
			let startDate = document.getElementById('fromDate').value;
			let endDate = document.getElementById('toDate').value;
			if(endDate !== '' && startDate !== ''){
				if(startDate > endDate){
					alert('Please select To Date is greater than From Date');
					$('#toDate').val('');
				}
			}
			getStatesForSupply(startDate,endDate);
		});

		$(document).on('change','#min_max_no_of_list',function(){
			var value = $(this).val();
			pagination(value);
		});

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

			    let supplyCommodity = $("#supply_commo option:selected").text();
				let supplyState = $("#supply_state option:selected").text();
				let supplyDistrict =$("#supply_district option:selected").text();

				$('#fromDate').val(todayDate);
				$('#toDate').val(afterDaysDate);

				let comm = supplyCommodity === 'Select Commodity' ? '' : supplyCommodity;
				let sName = supplyState === '--All--' ? '' : supplyState;
				let dName = supplyDistrict === '--All--' ? '' : supplyDistrict;

				getStatesForSupply(todayDate,afterDaysDate);
				getCommodity(todayDate,afterDaysDate,sName,dName)
				getAllSupplyData(todayDate,afterDaysDate,comm,sName,dName);
			}else{
				spinner.hide();
			}
		});
	});

	function getAllSupplyData(startDate,endDate,supplyCommodity,supplyState,supplyDistrict){
		var settings = {
		  	"url": "https://enam.gov.in/pop/rest/get_combine_supply_data",
		  	"method": "POST",
		  	"timeout": 0,
		  	"headers": {
		    	"Authorization": "Bearer d0obq7uvqi6i62kb1rc6tcetnc8jnbaq",
		    	"Content-Type": "application/json"
		  	},
		  	"data": JSON.stringify({
		    	"state": `${supplyState}`,
		    	"commodityid": `${supplyCommodity}`,
		    	"district": `${supplyDistrict}`,
		    	"fromDate": `${startDate}`,
		    	"toDate": `${endDate}`
		  	}),
		};

		$.ajax(settings).done(function (response) {
			let resData = response;
			let i=1, tableData = '';
			if(resData.data.length > 0){
				spinner.hide();
				data_array = [];
	    		$.each(resData.data,function(key,value){
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
				$('#advanceSupplyTable tbody').html('<tr><td colspan="11" style="text-align:center;">No record Found.</td></tr>');

				$('#supply_state').val('');
				$('#supply_district').val('');
				$('#supply_commo').val('');
			}
		});
	}	

	function getCommodity(startDate,endDate,supplyState,supplyDistrict){
		var settings = {
		  	"url": "https://enam.gov.in/pop/rest/queryapi/COMBINESUPPLYCOMM",
		  	"method": "POST",
		  	"timeout": 0,
		  	"headers": {
		    	"Content-Type": "application/json"
		  	},
		  	"data": JSON.stringify({
		    	"param1" : `${startDate}`,
				"param2": `${endDate}`,
				"param3": `${supplyState}`,
				"param4": `${supplyDistrict}`
		  	}),
		};

		$.ajax(settings).done(function (response) {
		  	if(response.status == "Success"){
	 			spinner.hide();
	 			let x = '<option value="">Select Commodity</option>';
	 			for(let data of response.data){
	 				x+=`<option value=${data.commodity_variety_name}>${data.commodity_variety_name}</option>`
	 			}
	 			$('#supply_commo').html(x)
	 		}else{
	 			spinner.hide();
	 		}
		});
	}

	function getStatesForSupply(startDate, endDate){

		var settings = {
		  	"url": "https://enam.gov.in/pop/rest/queryapi/COMBINESUPPLYSTATE",
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
		  	if(response.data.length > 0){
	 			spinner.hide();
				let x = '<option value="">--All--</option>';
	 			for(let data of response.data){
	 				x+=`<option value=${data.frm_state_name}>${data.frm_state_name}</option>`
	 			}
	 			$('#supply_state').html(x)
	 		}else{
	 			spinner.hide();
	 		}
		});
	}

	function pagination(start){
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
			
			if(i < array_length){
				x +=`<tr>
						<td align="center" style="text-align:center;">${k++}</td>
						<td align="center" style="text-align:center;">${data_array[i].frm_state_name}</td>
						<td align="center" style="text-align:center;">${data_array[i].frm_district_name}</td>
						<td align="center" style="text-align:center;text-transform: capitalize">${data_array[i].seller_name}</td>
						<td align="center" style="text-align:center;">${data_array[i].expected_arrival_date}</td>
						<td align="center" style="text-align:center;">${data_array[i].to_date}</td>
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
		$('#advanceSupplyTable tbody').html(x);
	}

	function getMonthAllDays(){
		var select = '<option value="">select days</option>';
		for (i=1;i<=30;i++){
		    select += '<option val=' + i + '>' + i + '</option>';
		}
		$('#arr_dropdown').html(select);
	}

</script>