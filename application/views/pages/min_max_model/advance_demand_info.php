<style type="text/css">
	
	.green-theme .content-section ul li {
	    background-image: none;
	}
	.content-section ul li {
	    padding-left: 1px;
    }
	.content-section h3.p-title {
	    font-size: 28px;
	    color: #0f0e0e;
	}
	

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

	.mandi-arrdays{  width: 100px;    height: 26px;    margin-left: 10px;float: right;margin-bottom: 8px;    padding: 0px 5px;}
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
			<div class="col-md-12 bc-nav" ><a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;<span id="bredcrum1">&nbsp;
				<a href="<?php echo base_url();?>dashboard"><?php echo $this->lang_file->heading_fetch('dashboard');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;<?php echo $this->lang_file->heading_fetch('min_max_manditrads');?>
			</div>
			<?php date_default_timezone_set("Asia/Kolkata");
				$date = date("Y-m-d");
			?>
			
			<div class="col-md-12"><h3 class="p-title"><?php echo $this->lang_file->heading_fetch('future_crop_demand');?></span></h3></div>
			<div class="col-sm-12 well e-trade-detail-box" >
				<div class="col-md-2 emandi-select e-trade-inputs" style="width: 190px;padding-left: 14px;">
					<b>From Date </b><span style="color:#F00;">*</span>
					<input type="text" name="fromDate" id="fromDate" class="form-control" placeholder="DD/MM/YYYY" autocomplete="off">
				</div>

				<div class="col-md-2 emandi-select e-trade-inputs" style="width: 180px;">
					<b>To Date </b><span style="color:#F00;">*</span>
					<input type="text" name="toDate" id="toDate" class="form-control" placeholder="DD/MM/YYYY" autocomplete="off">
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs" style="width: 180px;">
					<b><?php echo $this->lang_file->heading_fetch('min_max_state');?></b>
					<select class="form-control" id="min_max_state">
						<option value="null">-- All --</option>
					</select>
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs">
					<b><?php echo $this->lang_file->heading_fetch('min_max_district');?></b>
					<select class="form-control" id="trader_district" name="trader_district" style="width: 161px;">
						<option value="null">-- All --</option>
					</select>
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs" style="width: 180px;margin-left: -52px;">
					<b><?php echo $this->lang_file->heading_fetch('min_max_apmcs');?></b>
					<select class="form-control" id="min_max_apmc">
						<option value="null">-- All --</option>
					</select>
				</div>
				<div class="col-md-2 emandi-select e-trade-inputs" style="width: 180px;">
					<b><?php echo $this->lang_file->heading_fetch('min_max_commodity');?></b>
					<select class="form-control" id="min_max_commodity">
						<option value="null">Select Commodity</option>
					</select>
				</div>
				
				<div style="padding-right: 0;" class="col-md-2 emandi-select e-trade-refresh-b">
					<input style="margin-top:21px;" class="btn btn-primary" type="button" value="Search" id="refresh">
				</div>
			</div>

			<div class="row">
				<div class="col-md-12" style="margin-top:15px;">
					<div class="pull-left" id="mandi_content"><b><?php echo $this->lang_file->heading_fetch('arrival_expect');?>:</b> <select class="form-control mandi-arrdays" name="arr_dropdown" id="arr_dropdown"></select></div>

					<div class="pull-right"><b><?php echo $this->lang_file->heading_fetch('min-max-page');?>:</b> <select class="form-control mandi-pagi" name="min_max_no_of_list" id="min_max_no_of_list"></select></div>
				</div>
				<div class="col-md-12 table-responsive">	
				<table class="table table-striped table-bordered" id="future_crop_table">
					<thead>
						<tr>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('sr_no')?></th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_state');?></th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_district');?></th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('sub-dist');?></th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('village-town');?></th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_commodity');?></th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">Commodity Quantity</th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"> UOM</th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">Trader Name</th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">Expected Arrival</th>
		                </tr>
					</thead>
					<tbody class="tbodya" id="data_list"></tbody>
				</table>
			</div>
		</div>
	</div>
</section>

<div id="loader"></div>

<?php 
	$c = 1;
	$url_array ='';
	while($this->uri->segment($c) != ''){
		$url_array.= $this->uri->segment($c).'/';
		$c = $c + 1;
	}
	$url_array = strtolower(rtrim($url_array,"/ ")); 
?>

<script type="text/javascript">

	var dateToday = new Date();
    $("#fromDate").datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        maxDate: "+30d",
        yearRange: "-100:+0",
        minDate: dateToday,
    });

    $("#toDate").datepicker({
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        maxDate: "+30d",
        yearRange: "-100:+0",
        minDate: dateToday,
    });

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

	$(document).ready(function(){

		getFarmerState();
		getFarmerCommodity();

		$(document).on('change','#min_max_state', function(){
			getFarmerCommodity();
			let stateVal = $(this).val();
			let fromDate = $('#fromDate').val();
			let toDate = $('#toDate').val();
			let formateFromDate = changeDateFormat(fromDate) === 'undefined-undefined-' ? null : changeDateFormat(fromDate);
			let formateToDate = changeDateFormat(toDate) === 'undefined-undefined-' ? null : changeDateFormat(toDate);

			$.ajax({
				url:'<?php echo base_url();?>/Enam_ctrl/getAdvDemandTraderDistrict',
				method:'POST',
				dataType:'json',
				data:{
					stateVal:stateVal,
					formateFromDate:formateFromDate,
					formateToDate:formateToDate
				},
				success:function(resDistrict){
					let x = '<option value="null">-- All --</option>';
					if(resDistrict.status == 'S'){
						for(let data of resDistrict.listData){
							x+=`<option value=${data.traderDistrictId}>${data.traderDistrictName}</option>`;
						}
						$('#trader_district').html(x);
					}
				}
			})
		});

		$(document).on('change','#trader_district', function(){
			getFarmerCommodity();
			let stateVal = $('#min_max_state').val();
			let districtVal = $(this).val();
			let fromDate = $('#fromDate').val();
			let toDate = $('#toDate').val();
			let formateFromDate = changeDateFormat(fromDate) === 'undefined-undefined-' ? null : changeDateFormat(fromDate);
			let formateToDate = changeDateFormat(toDate) === 'undefined-undefined-' ? null : changeDateFormat(toDate);

			$.ajax({
				url:'<?php echo base_url();?>/Enam_ctrl/getAdvDemandTraderApmc',
				method:'POST',
				dataType:'json',
				data:{
					stateVal:stateVal,
					districtVal:districtVal,
					formateFromDate:formateFromDate,
					formateToDate:formateToDate
				},
				success:function(resApmc){
					let x = '<option value="null">-- All --</option>';
					if(resApmc.status == 'S'){
						for(let data of resApmc.listData){
							x+=`<option value=${data.traderApmcId}>${data.traderApmcName}</option>`;
						}
						$('#min_max_apmc').html(x);
					}
				}
			})
		});

		$(document).on('change','#min_max_apmc', function(){
			getFarmerCommodity();
		});

		$(document).on('change','#fromDate,#toDate', function(){
			let fromDate = $('#fromDate').val();
			let toDate = $('#toDate').val();

			if(toDate !== '' && fromDate !== ''){
				if(toDate < fromDate){
					alert('Please select To Date is greater than From Date');
					$('#toDate').val('');
				}
			}else{
				console.log('No issue');
			}
		});

		$(document).on('click', '#refresh', function(){
			let fromDate = $('#fromDate').val();
			let toDate = $('#toDate').val();
			let stateVal = $('#min_max_state').val();
			let districtVal = $('#trader_district').val();
			let apmcVal = $('#min_max_apmc').val();
			let commodityVal = $('#min_max_commodity').val();
			let arrivalDays = null;
			let formateFromDate = changeDateFormat(fromDate) === 'undefined-undefined-' ? null : changeDateFormat(fromDate);
			let formateToDate = changeDateFormat(toDate) === 'undefined-undefined-' ? null : changeDateFormat(toDate);
			getArrvial(stateVal,districtVal,apmcVal,commodityVal,arrivalDays,formateFromDate, formateToDate);			
		});

		$(document).on('change','#min_max_no_of_list',function(){
			var value = $(this).val();
			pagination(value);
		});

		$(document).on('change','#arr_dropdown', function(e){
		    e.preventDefault();
			let stateVal = $('#min_max_state').val();
			let districtVal = $('#trader_district').val();
			let apmcVal = $('#min_max_apmc').val();
			let commodityVal = $('#min_max_commodity').val();
			let arrivalDays = $(this).val();
			let fromDate = $('#fromDate').val();
			let toDate = $('#toDate').val();
			let formateFromDate = changeDateFormat(fromDate) === 'undefined-undefined-' ? null : changeDateFormat(fromDate);
			let formateToDate = changeDateFormat(toDate) === 'undefined-undefined-' ? null : changeDateFormat(toDate);

			getArrvial(stateVal,districtVal,apmcVal,commodityVal,arrivalDays,formateFromDate,formateToDate);
		});
	});

	function getArrvial(stateVal,districtVal,apmcVal,commodityVal,arrivalDays,fromDate, toDate){
		spinner.show();
		$.ajax({
			url:'<?php echo base_url();?>/Enam_ctrl/getAdvDemanadCropArrivals',
			method:'POST',
			dataType:'json',
			data:{
				stateVal:stateVal,
				districtVal:districtVal,
				apmcVal:apmcVal,
				commodityVal:commodityVal,
				arrivalDays:arrivalDays,
				fromDate:fromDate,
				toDate:toDate 
			},
			success:function(response){
				let i=1, tableData = '';
				if(response.status == 'S'){
					spinner.hide();
					if(response.listAdvFarmerSupply.length > 0){
						data_array = [];
			    		$.each(response.listAdvFarmerSupply,function(key,value){
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
				}
				else{
					spinner.hide();
					$('#future_crop_table tbody').html('<tr><td colspan="11" style="text-align:center;">No record Found.</td></tr>');
					
				}
			}
		});
	}

	function getFarmerState(){
		let fromDate = $('#fromDate').val();
		let toDate = $('#toDate').val();
		let formateFromDate = changeDateFormat(fromDate) === 'undefined-undefined-' ? null : changeDateFormat(fromDate);
		let formateToDate = changeDateFormat(toDate) === 'undefined-undefined-' ? null : changeDateFormat(toDate);
		$.ajax({
			url:'<?php echo base_url();?>/Enam_ctrl/getAdvDemandTraderState',
			method:'POST',
			dataType:'json',
			data:{formateFromDate:formateFromDate,
				formateToDate:formateToDate},
			success:function(resState){
				let x = '<option value="null">-- All --</option>';
				if(resState.status == 'S'){
					for(let data of resState.listData){
						x+=`<option value=${data.traderStateId}>${data.traderStateName}</option>`;
					}
					$('#min_max_state').html(x);
				}
			}
		})
	}

	function getFarmerCommodity(){
		let stateVal = $('#min_max_state').val();
		let districtVal = $('#trader_district').val();
		let apmcVal = $('#min_max_apmc').val();
		let fromDate = $('#fromDate').val();
		let toDate = $('#toDate').val();
		let formateFromDate = changeDateFormat(fromDate) === 'undefined-undefined-' ? null : changeDateFormat(fromDate);
		let formateToDate = changeDateFormat(toDate) === 'undefined-undefined-' ? null : changeDateFormat(toDate);

		$.ajax({
			url:'<?php echo base_url();?>/Enam_ctrl/getAdvDemandTraderCommodity',
			method:'POST',
			dataType:'json',
			data:{
				stateVal:stateVal,
				districtVal:districtVal,
				apmcVal:apmcVal,
				formateFromDate:formateFromDate,
				formateToDate:formateToDate
			},
			success:function(resCommodity){
				let x = '<option value="null">Select Commodity</option>';
				if(resCommodity.status == 'S'){
					for(let data of resCommodity.listData){
						x+=`<option value=${data.commodityVarietyId}>${data.commodityVarietyName}</option>`;
					}
					$('#min_max_commodity').html(x);
				}
			}
		})
	}

	var testArr=[];
	var dayArr = [];
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
				//diffDays(data_array[i].expectedArrivalDate);
				testArr.push(data_array[i].expectedArrivalDate);
				x = x + `<tr>
							<td align="center" style="text-align:center;">${k++}</td>
							<td align="center" style="text-align:center;">${data_array[i].traderStateName}</td>
							<td align="center" style="text-align:center;">${data_array[i].traderDistrictName == null ? `-` : `${data_array[i].traderDistrictName}`}</td>

							<td align="center" style="text-align:center;">${data_array[i].farmerTehsilName == null ? `-` : `${data_array[i].farmerTehsilName}`}</td>

							<td align="center" style="text-align:center;">${data_array[i].farmerCityName == null ? `-` : `${data_array[i].farmerCityName}`}</td>
							<td align="center" style="text-align:center;">${data_array[i].commodityVarietyName == null ? `-` : `${data_array[i].commodityVarietyName}`}</td>
							<td align="center" style="text-align:center;">${data_array[i].commodityQty}</td>
							<td align="center" style="text-align:center;">${data_array[i].qtyUom}</td>
							<td align="center" style="text-align:center;">${data_array[i].buyerName}</td>
							<td align="center" style="text-align:center;">${getMonthFunction(data_array[i].expectedArrivalDate)} </td>
						</tr>`;
						
			}
			else{
	    		break;
			}
		}
		diffDays(); 
		$('#future_crop_table tbody').html(x);
	}

	function diffDays(){
		
		while (dayArr.length) {
		    // Remove elements from array
		    dayArr.pop();
		}

		var x = '<option>select days</option>';
		var rrr = testArr.filter((v, i, a) => a.indexOf(v) === i);
		let pp = rrr.toString();
		let newDate = pp.replace(/-/g, "/");
		var datearray = newDate.split(",");

		//for getting today date
		const today = new Date();
		const yyyy = today.getFullYear();
		let mm = today.getMonth() + 1;
		let dd = today.getDate();
		if (dd < 10) dd = '0' + dd;
		if (mm < 10) mm = '0' + mm;
		const todayDate = mm + '/' + dd + '/' + yyyy;

		for(let data of datearray){
			//console.log('to check dates',data);
			var aa = data.split('/');
			var newdate = aa[1] + '/' + aa[0] + '/' + aa[2];
			const date1 = new Date(newdate);
			const date2 = new Date(todayDate);
			const diffTime = Math.abs(date1 - date2);
			const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
			dayArr.push(diffDays);
			//dayArr.push(10);
		}

		dayArr.sort(function(a, b){return a - b});
		for(let data of dayArr){			
			x+=`<option value=${data}>${data}</option>`;
		}
		$('#arr_dropdown').html(x);
	}

	function getMonthFunction(test){
		var testDate = test;
		var newDate = testDate.replace(/-/g, "/");
		var aa = newDate.split('/');
		const d = new Date(aa[1]);
		const monthArr = ['January', 'February','March','April','May','June','July','August','September','October','November','December'];

		var monthIndex = d.getMonth();
		var monthName = monthArr[monthIndex];
		var dateWithMonth = aa[0] + ' ' + monthName + ' ' + aa[2];
		return dateWithMonth;
	}

	function changeDateFormat(date){
		var aa = date.split('/');
		let formatDate = `${aa[2]}-${aa[1]}-${aa[0]}`;
		return formatDate;
	}

</script>

