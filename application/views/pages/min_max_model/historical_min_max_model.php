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
<a href="<?php echo base_url();?>dashboard"><?php echo $this->lang_file->heading_fetch('dashboard');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;<?php echo $this->lang_file->heading_fetch('historical_trade_data');?></div>
<?php date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
?>
<div class="col-md-12" style="padding:0px;"><h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('historical_min_max_mandi_trade');?></span></h3></div>

<div class="col-sm-12 well e-trade-detail-box" >
<input type="hidden" id="previous_date" value="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>">
<input type="hidden" id="current_date" value="<?php echo $date;?>">
<div class="col-md-2 emandi-select e-trade-inputs" style="padding-left:15px;">
<b><?php echo $this->lang_file->heading_fetch('min_max_state');?></b>
<select class="form-control" id="min_max_state">
	<option value="">-- All --</option>
</select>
</div>
<div class="col-md-2 emandi-select e-trade-inputs">
<b><?php echo $this->lang_file->heading_fetch('min_max_apmcs');?></b>
<select class="form-control" id="min_max_apmc">
	<option value="0">-- Select APMCs --</option>
</select>
</div>
<div class="col-md-2 emandi-select e-trade-inputs">
<b><?php echo $this->lang_file->heading_fetch('min_max_commodity');?></b>
<select class="form-control" id="min_max_commodity">
	<option value="0">-- Select Commodity --</option>
</select>
</div>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js"></script>
<!-- <div class="col-md-2 emandi-select e-trade-inputs1"><b><?php echo $this->lang_file->heading_fetch('min_max_from_date');?></b> <input class="form-control" type="date" id="min_max_apmc_from_date" min="<?php echo date('Y-m-d', strtotime($date .' -180 day'));?>" max="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>"/></div>

<div class="col-md-2 emandi-select e-trade-inputs1"><b><?php echo $this->lang_file->heading_fetch('min_max_to_date');?></b> <input class="form-control" type="date" id="min_max_apmc_to_date" min="<?php echo date('Y-m-d', strtotime($date .' -7 day'));?>" max="<?php echo $date;?>"/></div> -->

<div class="col-md-2 emandi-select e-trade-inputs1"><b><?php echo $this->lang_file->heading_fetch('min_max_from_date');?></b>
<input style="cursor: pointer;" id="min_max_apmc_from_date" class="form-control datepicker" type="text" name="min_max_apmc_from_date" min="<?php echo date('Y-m-d', strtotime($date .' -180 day'));?>" max="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>"><i class="fa fa-calendar" style="margin-top: -24px;
    margin-left: 180px;pointer-events: none;"></i></div>
<div class="col-md-2 emandi-select e-trade-inputs1"><b><?php echo $this->lang_file->heading_fetch('min_max_to_date');?></b> 
<input readonly='readonly' id="min_max_apmc_to_date" class="form-control datepicker" type="text" name="min_max_apmc_to_date" min="<?php echo date('Y-m-d', strtotime($date .' -7 day'));?>" max="<?php echo $date;?>"><i class="fa fa-calendar" style="margin-top: -24px;
    margin-left: 180px;pointer-events: none;"></i></div>



<div style="padding-right: 0;" class="col-md-2 emandi-select e-trade-refresh-b">
	<input style="margin-top:21px;" class="btn btn-refresh" type="button" value="<?php echo $this->lang_file->heading_fetch('refresh-btn');?>" id="refresh">
</div>

<div style="" class="col-md-12 emandi-select" align="right">
	<input class="btn btn-info" type="button" value="<< Click here for the historical data" id="sevenDaysdata"  >
</div>

</div>
<style type="text/css">
	.active {
    /* background-color: #fff; */
    color: #0df153 !important;
    font-weight: bold;
}
.disabled.day
{
	color: #eaeaea;
}
.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top
{
	padding: 6px;
}
</style>


<script type="text/javascript">
 		$('#min_max_apmc_from_date').datepicker({
            format: "yyyy-mm-dd",
            endDate: '-1d',
            startDate: '-180d',
        });
         $('#min_max_apmc_to_date').datepicker({
            format: "yyyy-mm-dd",
            endDate: '-1d',
            startDate: '-180d',

        }).attr('disabled', true);;

$("#min_max_apmc_from_date").datepicker().datepicker('setDate', '-1d');
$("#min_max_apmc_to_date").datepicker().datepicker('setDate', '-1d');


 $('#min_max_apmc_from_date').change(function() {
  var date2 = $('#min_max_apmc_from_date').datepicker('getDate', '+1d');
  date2.setDate(date2.getDate()+6);
  $('#min_max_apmc_to_date').datepicker('setDate', date2);

var tdate =$('#min_max_apmc_to_date').val();
if (tdate == '') 
{
	$("#min_max_apmc_to_date").datepicker().datepicker('setDate', '-1d');
}

});

</script>

<div class="row">
<div class="col-md-12" style="margin-top:15px;">
<div class="pull-left" style="font-size:15px;" id="mandi_content"><b>

<?php $date = date("Y-m-d"); ?>
<?php echo $this->lang_file->heading_fetch('min_max_trading_detail');?>: <span id="mandi_from_date"></span> to <span id="mandi_to_date"></span></b>

</div>
<div class="pull-right"><b><?php echo $this->lang_file->heading_fetch('min-max-page');?>:</b> <select class="form-control mandi-pagi" name="min_max_no_of_list" id="min_max_no_of_list"></select></div>
</div>
<div class="col-md-12 table-responsive">	
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_state');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_apmcs');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_commodity');?></th>
            <th colspan="3" style="text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_price_rs');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_commodity_arrivalss');
			?></th>
			<!-- <th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php //echo $this->lang_file->heading_fetch('min_max_commodity_arrival_qom');
			
			?></th> -->
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('commodity_traded_min_max');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('measurement_unit');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_date');?></th>
		</tr>
                <tr>
                        <th><?php echo $this->lang_file->heading_fetch('min_max_minprice');?></th>
			<th><?php echo $this->lang_file->heading_fetch('min_max_modalprice');?></th>
			<th><?php echo $this->lang_file->heading_fetch('min_max_maxprice');?></th>
                </tr>
	</thead>
	<tbody class="tbodya" id="data_list"></tbody>
</table>
</div>
</div>
</div>
</section>


<!--  <input id="agm_min_max_apmc_from_date" class="form-control datepicker" type="hidden" name="agm_min_max_apmc_from_date" value="2021-11-11">
<input id="agm_min_max_apmc_todate" class="form-control datepicker" type="hidden" name="agm_min_max_apmc_todate"> -->

<input style="cursor: pointer;" id="agm_min_max_apmc_from_date" class="form-control datepicker" type="hidden" name="agm_min_max_apmc_from_date" />
<input style="cursor: pointer;" id="agm_min_max_apmc_to_date" class="form-control datepicker" type="hidden" name="agm_min_max_apmc_from_date" />

	<script type="text/javascript">
		$(function () {
		    $("#agm_min_max_apmc_from_date").datepicker({
		      		format: "yyyy-mm-dd",
		            // endDate: new Date(),
		            startDate: '-175d',
		    });
			$("#agm_min_max_apmc_from_date").datepicker().datepicker('setDate', '+0d');

			$("#agm_min_max_apmc_to_date").datepicker({
		      		format: "yyyy-mm-dd",
		            // endDate: new Date(),
		            startDate: '-169d',
		    });
			$("#agm_min_max_apmc_to_date").datepicker().datepicker('setDate', '+6d');

		    $("#sevenDaysdata").click(function () {
		        addDaysToDate();
		    });
		});

function addDaysToDate() {
    var date3 = $('#agm_min_max_apmc_from_date').datepicker('getDate');
    date3.setDate(date3.getDate() - 7);
    $('#agm_min_max_apmc_from_date').datepicker('setDate', date3);
    $('#agm_min_max_apmc_from_date').change();

    var date4 = $('#agm_min_max_apmc_to_date').datepicker('getDate');
    date4.setDate(date4.getDate() - 7);
    $('#agm_min_max_apmc_to_date').datepicker('setDate', date4);
    $('#agm_min_max_apmc_to_date').change();
    fetch_table_data_1();



	$('#mandi_from_date').html(formatDate($('#agm_min_max_apmc_from_date').val()));
	$('#mandi_to_date').html(formatDate($('#agm_min_max_apmc_to_date').val()));	

	var frdate =$('#agm_min_max_apmc_from_date').val();
	var todate =$('#agm_min_max_apmc_to_date').val();
	if (frdate == '' && todate == '') 
	{
		// alert("works");
		$("#agm_min_max_apmc_from_date").datepicker().datepicker('setDate', '-7d');
		$("#agm_min_max_apmc_to_date").datepicker().datepicker('setDate', '-1d');

		$('#mandi_from_date').html(formatDate($('#agm_min_max_apmc_from_date').val()));
		$('#mandi_to_date').html(formatDate($('#agm_min_max_apmc_to_date').val()));
    	fetch_table_data_1();
	}
}
	</script>

<script type="text/javascript">
	// function addDays(dateObj, numDays) {
	//    dateObj.setDate(dateObj.getDate() + numDays);
	//    return dateObj;
	// }
	// var previous = addDays(new Date(), -1);
 // 		 month = '' + (previous.getMonth() + 1),
 //         day = '' + previous.getDate(),
 //         year = previous.getFullYear();
 //     if (month.length < 2) month = '0' + month;
 //     if (day.length < 2) day = '0' + day;
 //     var previous =  [year, month, day].join('-');	


	// var lastWeek = addDays(new Date(), -7);
 // 		 month = '' + (lastWeek.getMonth() + 1),
 //         day = '' + lastWeek.getDate(),
 //         year = lastWeek.getFullYear();
 //     if (month.length < 2) month = '0' + month;
 //     if (day.length < 2) day = '0' + day;
 //     var lastWeek =  [year, month, day].join('-');	

    // $("#seven").click(function () {
        
    // });

</script>

<?php 
$c = 1;
		$url_array ='';
		while($this->uri->segment($c) != ''){
			$url_array.= $this->uri->segment($c).'/';
			$c = $c + 1;
		}
		$url_array = strtolower(rtrim($url_array,"/ ")); 
		?>
<script>
var baseUrl = $('#base_url').val();
$.ajax({
	type: 'post',
	url: baseUrl+'Ajax_ctrl/menu_activate/<?php echo $url_array;?>',
	dataType: "json",
	data:{},
	beforeSend: function(){},
	complete: function(){},
	success: function (response){
		if(response.status == 200){
			console.log(response);
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
</script>

<script type= "text/javascript">
	$('#min_max_apmc_from_date').on('keydown', function(event) {
		console.log(event);
	    if (event.keyIdentifier == "Down") {
	        event.preventDefault()
	    }
	}, false);

	$('#min_max_apmc_to_date').on('keydown', function(event) {
		console.log(event);
	    if (event.keyIdentifier == "Down") {
	        event.preventDefault()
	    }
	}, false);
	

function number_formate(num){
	var a = num;
	 var b = ",";
	 if(a.length == 4){
		 var position = 1;
		 var output = [a.slice(0, position), b, a.slice(position)].join('');
	 }
	 else if(a.length == 5){
		 var position = 2;
		 var output = [a.slice(0, position), b, a.slice(position)].join('');
	 }
	 else if(a.length == 6){
		 var position = 1;
		 var output = [a.slice(0, position), b, a.slice(position)].join('');
		 var position = 4;
		 var output = [output.slice(0, position), b, output.slice(position)].join('');
	 }
	 else if(a.length == 7){
		 var position = 2;
		 var output = [a.slice(0, position), b, a.slice(position)].join('');
		 var position = 5;
		 var output = [output.slice(0, position), b, output.slice(position)].join('');
	 }
	 else if(a.length == 8){
		 var position = 1;
		 var output = [a.slice(0, position), b, a.slice(position)].join('');
		 var position = 4;
		 var output = [output.slice(0, position), b, output.slice(position)].join('');
		 var position = 7;
		 var output = [output.slice(0, position), b, output.slice(position)].join('');
	 }
	 else{
		 var output = num;
	 }
	return output;
}

$('#min_max_apmc_from_date').val($('#previous_date').val());
$('#min_max_apmc_to_date').val($('#previous_date').val());

//////////////fetch state////////////////////////////////////
$.ajax({
	    type: 'POST',
	    url: baseUrl+'ajax_ctrl/states_name',
	    dataType: "json",
	    data: {},
	    beforeSend: function(){
	    },
	    complete: function(){},
		success:function (response) {
			if(response.status == 200){
				var x = '<option value="">-- All --</option>';
				$.each(response.data,function(key,value){
					x = x + '<option value="'+ value.state_id +'">'+ value.state_name +'</option>';
				});
				$('#min_max_state').html(x);
			}
		}
});

$(document).on('change','#min_max_no_of_list',function(){
	var value = $(this).val();
	pagination(value);
});

$(document).on('change','#min_max_commodity,#min_max_apmc_from_date,#min_max_apmc_to_date',function(){
	//fetch_table_data();
	
	$('#min_max_no_of_list').val(start);
});
$(document).on('click','#refresh',function(){
	fetch_table_data();
	$('#min_max_no_of_list').val(start);
});

var start = 0;
var limit = 10;
var data_array = [];

function fetch_table_data(){
	var stateName = $("#min_max_state option:selected").text();
	var apmcName = $("#min_max_apmc option:selected").text();
	var commodityName =  $("#min_max_commodity option:selected").text();
	var from_date = $('#min_max_apmc_from_date').val();
	var to_date =$('#min_max_apmc_to_date').val();
	
	$.ajax({
	    type: 'POST',
	    url: baseUrl+'Ajax_ctrl/trade_data_list',
	    dataType: "json",
	    data: {
	    	'language' : 'en',
	    	'stateName' : stateName,
	    	'apmcName' :apmcName,
	    	'commodityName' : commodityName, 
	    	'fromDate' : from_date,
	 		'toDate' : to_date
	    },
	    beforeSend: function(){
	    },
	    complete: function(){},
		success:function (response) {
			if(response.status == 200){
				data_array = [];
	    		$.each(response.data,function(key,value){
	    			data_array.push(value);
	    		});
	    		var array_length = data_array.length;
	    		var pages = parseInt(parseInt(array_length)/parseInt(limit));
	    		var y = '';
	    		for(var i = 0;i<= pages; i++){
	        		y = y + '<option value="'+ i +'">'+ parseInt(parseInt(i)+1) +'</option>';
	    		}
	    		$('#min_max_no_of_list').html(y);
	    		pagination(start);
			}
			else{
				$('#data_list').html('<tr><td colspan="11" style="text-align:center;">No record Found.</td></tr>');					
			}
			console.log(response);
		}
	});
	
	$('#mandi_from_date').html(formatDate($('#min_max_apmc_from_date').val()));
	$('#mandi_to_date').html(formatDate($('#min_max_apmc_to_date').val()));
}

function pagination(start){
	var array_length = data_array.length;
// console.log(data_array);
	if(start != 0){
		slug = 1;
		}
	else{
		slug = 0;
	}
	var x = '';
	
	for(var i = parseInt(parseInt(start*limit)+slug); i <= (parseInt(parseInt(parseInt(start)*10))+10); i++){

		if(i < array_length){
			x = x + '<tr>'+
					'<td align="center" style="text-align:center;">'+ data_array[i].state +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array[i].apmc +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array[i].commodity +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].min_price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].modal_price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].max_price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].commodity_arrivals) +'</td>'+
					
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].commodity_traded) +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array[i].Commodity_Uom +'</td>'+
					'<td align="center" style="text-align:center;">'+ formatDate(data_array[i].created_at) +'</td>';
				x = x + '</tr>';  
		}
		else{
    		break;
		}
	} 
	$('#data_list').html(x);
}
//-----------------------------------------------------------------------------------------------------//
function formatDate(date) {
     var d = new Date(date),
         month = '' + (d.getMonth() + 1),
         day = '' + d.getDate(),
         year = d.getFullYear();

     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     return [day, month, year].join('-');
 }



$(document).on('change','#min_max_state',function(){
	$('#min_max_apmc').val(0);
	$('#min_max_commodity').val(0);
	var stateId = $('#min_max_state').val();
	$.ajax({
		    type: 'POST',
		    url: baseUrl + 'Ajax_ctrl/apmc_list',
		    dataType: "json",
		    data: {
		    	'state_id' : stateId
		    },
		    beforeSend: function(){
		    	
		    },
		    complete: function(){},
		    success:function (response) {
		    	var x = '<option value="0">-- Select APMCs --</option>';
		    	$.each(response.data,function(key,value){
					if($('#apmc_id_param').val() == value.apmc_id){
						x = x + '<option value="'+ value.apmc_id +'" selected>'+ value.apmc_name +'</option>';								
					}
					else {
						x = x + '<option value="'+ value.apmc_id +'">'+ value.apmc_name +'</option>'; 
					}
		    	});
		    	$('#min_max_apmc').html(x);
		    }
		});
	commodity_list();
	$('#min_max_no_of_list').val(start);
});
	//-----------------------------------------------------------------------------------------------------
	$(document).on('change','#min_max_apmc',function(){
		commodity_list();
	});
//------------------------------------------------------------
//function written on dated 13 july 19  by SB

$(document).on('change','#min_max_apmc_from_date',function(){
		commodity_list();
	});

////////
function commodity_list(){
		$('#min_max_commodity').val(0);
        var stateName = $("#min_max_state option:selected").text();
		var apmcName =$("#min_max_apmc option:selected").text();
		var from_date = $('#min_max_apmc_from_date').val();
		var to_date =$('#min_max_apmc_to_date').val();
		var array = {'language' : 'en',
	 		    	'stateName' : stateName,
					'apmcName' : apmcName,
	 		    	'fromDate' : from_date,
	 	 		'toDate' : to_date}
			$.ajax({
	 		    type: 'POST',
	 		    url: baseUrl+'Ajax_ctrl/commodity_list',
	 		    dataType: "json",
	 		    data: array,
	 		    beforeSend: function(){	
	 		    },
	 		    complete: function(){},
	 		    success:function (response) {
	 		    	console.log(response);
	 		    	var x = '<option value="0">-- Select Commodity --</option>';
	 		    	$.each(response.data,function(key,value){
	 		    		x = x + '<option value="'+ value.commodity +'">'+ value.commodity +'</option>'; 
					});
	 		    	$('#min_max_commodity').html(x);
					
	 		    }
			});
			$('#min_max_no_of_list').val(start);
}

//////////////////////////////////////////////////////////////////
if((typeof($('#apmc_id_param').val()) != "undefined" && $('#apmc_id_param').val() !== 'null') && (typeof($('#apmc_id_param').val()) != "0" && $('#apmc_id_param').val() !== '0')){
	setTimeout(function(){
	console.log('first time function call');
	  var state = $('#state_id_param').val();
	  $('#min_max_state').val(state);
	  $('#min_max_state').trigger('change');
	}, 3000);

	setTimeout(function(){
	console.log('second time function call');
	  commodity_list();
	  $('#refresh').trigger('click');
	}, 5000);
}
else{
	fetch_table_data();
}

</script>

<script type="text/javascript">
	
var start_1 = 0;
var limit_1 = 10;
var data_array_1 = [];
function fetch_table_data_1(){
	var stateName = $("#min_max_state option:selected").text();
	var apmcName = $("#min_max_apmc option:selected").text();
	var commodityName =  $("#min_max_commodity option:selected").text();
	var from_date = $('#agm_min_max_apmc_from_date').val();
	var to_date =$('#agm_min_max_apmc_to_date').val();

	$.ajax({
	    type: 'POST',
	    url: baseUrl+'Ajax_ctrl/trade_data_list',
	    dataType: "json",
	    data: {
	    	'language' : 'en',
	    	'stateName' : stateName,
	    	'apmcName' :apmcName,
	    	'commodityName' : commodityName, 
	    	'fromDate' : from_date,
	 		'toDate' : to_date
	    },
	    beforeSend: function(){
	    },
	    complete: function(){},
		success:function (response) {
			if(response.status == 200){
				data_array_1 = [];
	    		$.each(response.data,function(key,value){
	    			data_array_1.push(value);
	    		});
	    		var array_length_1 = data_array_1.length;
	    		var pages_1 = parseInt(parseInt(array_length_1)/parseInt(limit_1));
	    		var y_1 = '';
	    		for(var i = 0;i<= pages_1; i++){
	        		y_1 = y_1 + '<option value="'+ i +'">'+ parseInt(parseInt(i)+1) +'</option>';
	    		}
	    		$('#min_max_no_of_list').html(y_1);
	    		pagination_1(start_1);
			}
			else{
				$('#data_list').html('<tr><td colspan="11" style="text-align:center;">No record Found.</td></tr>');					
			}
			console.log(response);
		}

	});
	
	$('#mandi_from_date').html(formatDate($('#min_max_apmc_from_date').val()));
	$('#mandi_to_date').html(formatDate($('#min_max_apmc_to_date').val()));
}


function pagination_1(start_1){
	var array_length_1 = data_array_1.length;
// console.log(data_array);
	if(start_1 != 0){
		slug_1 = 1;
		}
	else{
		slug_1 = 0;
	}
	var x_1 = '';
	
	for(var i = parseInt(parseInt(start_1*limit_1)+slug_1); i <= (parseInt(parseInt(parseInt(start_1)*10))+10); i++){

		if(i < array_length_1){
			x_1 = x_1 + '<tr>'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].state +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].apmc +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].commodity +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].min_price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].modal_price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].max_price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].commodity_arrivals) +'</td>'+
					
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].commodity_traded) +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].Commodity_Uom +'</td>'+
					'<td align="center" style="text-align:center;">'+ formatDate(data_array_1[i].created_at) +'</td>';
				x_1 = x_1 + '</tr>';  
		}
		else{
    		break;
		}
	} 
	$('#data_list').html(x_1);
}
</script>