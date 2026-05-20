<?php 
if(isset($param_state) && isset($param_apmc) && isset($param_commodity)){ ?>
  <input type="hidden" id="state_id_param" value="<?php echo $param_state; ?>">
  <input type="hidden" id="apmc_id_param" value="<?php echo $param_apmc; ?>">
  <input type="hidden" id="commodity_id_param" value="<?php echo $param_commodity; ?>">
<?php }?>

<section class="title-header-bg-apmc"></section>
<section class="container-fuild content-section" style="background: #FCF8E3">
<div class="container">
<div class="" style="margin-top:10px;">
<div class="col-md-12 bc-nav" ><a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;<span id="bredcrum1">&nbsp;
<a href="<?php echo base_url();?>dashboard"><?php echo $this->lang_file->heading_fetch('dashboard');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;<?php echo $this->lang_file->heading_fetch('live_price');?></div>
<?php date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
?>
<input type="hidden" id="previous_date" value="<?php echo date('Y-m-d', strtotime($date .' -0 day'));?>">
<input type="hidden" id="current_date" value="<?php echo $date;?>">


<?php date_default_timezone_set("Asia/Kolkata");
$date_1 = date("Y-m-d");
?>
<input type="hidden" id="previous_date_1" value="<?php echo date('Y-m-d', strtotime($date_1 .' -0 day'));?>">
<input type="hidden" id="current_date_1" value="<?php echo $date_1;?>">


<div class="col-md-12" style="padding:0px;"><h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('enam_mandies_live');?></span></h3></div>
<div align="center">
	  <img src="<?php echo base_url();?>/assest/images/live-image-2.gif" alt="Chicago" style="height: 65px;">
	
</div>
<div align="center">
        <label class="radio-inline"><input type="radio" name="colorRadio" value="green"> <b>State Wise</b></label>
        <label class="radio-inline"><input type="radio" name="colorRadio" value="blue"> <b>Commodity Wise</b></label>
 </div>
 <script>
		$(document).ready(function(){
		    $('input[type="radio"]').click(function(){
		        var inputValue = $(this).attr("value");
		        var targetBox = $("." + inputValue);
		        $(".box").not(targetBox).hide();
		        $(targetBox).show();
		    });
		});
</script>

<div class="row green box " style="display: none">
<div class="col-md-5"></div>
<div class="col-md-2 emandi-select e-trade-inputs" align="center" style="margin-top: 15px">
<b><?php echo $this->lang_file->heading_fetch('min_max_state');?></b>
<select class="form-control" id="min_max_state">
	<option value="">-- Select State --</option>
	<option value="">-- All --</option>
</select>
</div>

<div class="col-md-2 emandi-select e-trade-inputs1" style="display: none"><b><?php echo $this->lang_file->heading_fetch('min_max_from_date');?></b> <input class="form-control" type="hidden" id="min_max_apmc_from_date" min="<?php echo date('Y-m-d', strtotime($date .' -7 day'));?>" max="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>"/></div>
<div class="col-md-2 emandi-select e-trade-inputs1" style="display: none"><b><?php echo $this->lang_file->heading_fetch('min_max_to_date');?></b> <input class="form-control" type="hidden" id="min_max_apmc_to_date" min="<?php echo date('Y-m-d', strtotime($date .' -7 day'));?>" max="<?php echo $date;?>"/></div>


<div class="col-md-12" style="margin-top:15px;">
<div class="pull-left" style="font-size:15px;" id="mandi_content"><b>

<?php $date = date("Y-m-d"); ?>
<?php echo $this->lang_file->heading_fetch('min_max_trading_detail');?>: <span id="table_mandi_from_date"></span></b>

</div>
<!-- <div class="pull-right"><b>Page:</b> <select class="form-control mandi-pagi" name="min_max_no_of_list" id="min_max_no_of_list"></select></div> -->
</div>
<div class="col-md-12 table-responsive">	
<table class="table table-bordered">
	<thead class="alert alert-success" style="background: #F2DEDE">
		<tr style="background: #F2DEDE">
			<!-- <th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php //echo $this->lang_file->heading_fetch('min_max_state');?></th> -->
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_apmcs');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_commodity');?></th>
            <th colspan="3" style="text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_per_quintal');?></th>
			<!-- <th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php //echo $this->lang_file->heading_fetch('min_max_commodity_arrivals');
			?></th> -->
			<!-- <th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php //echo $this->lang_file->heading_fetch('min_max_commodity_arrival_qom');
			
			?></th> -->
			<!-- <th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php //echo $this->lang_file->heading_fetch('min_max_commodity_traded');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php //echo $this->lang_file->heading_fetch('measurement_unit');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php //echo $this->lang_file->heading_fetch('min_max_date');?></th> -->
		</tr>
                <tr>
                    <th><?php echo $this->lang_file->heading_fetch('min_max_minprice');?></th>
			        <th><?php echo $this->lang_file->heading_fetch('min_max_modalprice');?></th>
			        <th><?php echo $this->lang_file->heading_fetch('min_max_maxprice');?></th>
                </tr>
	</thead>
	<tbody class="tbodya alert alert-success" id="data_list"></tbody>
</table>
</div>
</div>

<div class="row blue box" style="display: none">
<div class="col-md-5"></div>
<div class="col-md-2 emandi-select e-trade-inputs" align="center" style="margin-top: 15px">
<b><?php echo $this->lang_file->heading_fetch('min_max_commodity');?></b>
<select class="form-control" id="min_max_commodity">
	<option value="">-- Select Commodity --</option>
	<option value="">-- All --</option>
</select>
</div>

<div class="col-md-2 emandi-select e-trade-inputs1" style="display: none"><b><?php echo $this->lang_file->heading_fetch('min_max_from_date');?></b> <input class="form-control" type="date" id="min_max_apmc_from_date_1" min="<?php echo date('Y-m-d', strtotime($date_1 .' -7 day'));?>" max="<?php echo date('Y-m-d', strtotime($date_1 .' -1 day'));?>"/></div>
<div class="col-md-2 emandi-select e-trade-inputs1" style="display: none"><b><?php echo $this->lang_file->heading_fetch('min_max_to_date');?></b> <input class="form-control" type="date" id="min_max_apmc_to_date_1" min="<?php echo date('Y-m-d', strtotime($date_1 .' -7 day'));?>" max="<?php echo $date_1;?>"/></div>

<div class="col-md-12" style="margin-top:15px;">
<div class="pull-left" style="font-size:15px;" id="mandi_content"><b>

<?php $date = date("Y-m-d"); ?>
<?php echo $this->lang_file->heading_fetch('min_max_trading_detail');?>: <span id="table_mandi_from_date_1"></span></b>

</div>
<!-- <div class="pull-right"><b>Page:</b> <select class="form-control mandi-pagi" name="min_max_no_of_list_1" 
	id="min_max_no_of_list_1"></select></div> -->
</div>
<div class="col-md-12 table-responsive">	
<table class="table table-bordered">
	<thead>
		<tr>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_state');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_apmcs');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_commodity');?></th>
            <th colspan="3" style="text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_per_quintal');?></th>
	<!-- 		<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php //echo $this->lang_file->heading_fetch('min_max_commodity_arrivals');
			?></th> -->
			<!-- <th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php //echo $this->lang_file->heading_fetch('min_max_commodity_arrival_qom');
			
			?></th> -->
			<!-- <th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php //echo $this->lang_file->heading_fetch('min_max_commodity_traded');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php //echo $this->lang_file->heading_fetch('measurement_unit');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php //echo $this->lang_file->heading_fetch('min_max_date');?></th> -->
		</tr>
                <tr>
                        <th><?php echo $this->lang_file->heading_fetch('min_max_minprice');?></th>
			<th><?php echo $this->lang_file->heading_fetch('min_max_modalprice');?></th>
			<th><?php echo $this->lang_file->heading_fetch('min_max_maxprice');?></th>
                </tr>
	</thead>
	<tbody class="tbodya alert alert-success" id="data_list_1"></tbody>
</table>
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


<script type="text/javascript">
	var baseUrl = $('#base_url').val();
	current_date();
	function current_date(){
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'Liveprice_ctrl/current_date',
	        dataType: "json",
	        data: {
			},
	        beforeSend: function(){},
	        complete: function(){},
	        success:function (response) {
	        	if(response.status == 200){
						$.each(response.data,function(key,value){
							$('#table_mandi_from_date').html(formatDateTime(value.created_at));
							$('#table_mandi_from_date_1').html(formatDateTime(value.created_at));
						});
				}
	        }
		});
	}
</script>


<script>
var baseUrl = $('#base_url').val();
$.ajax({
	type: 'post',
	url: baseUrl+'Liveprice_ctrl/menu_activate/<?php echo $url_array;?>',
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
	var from_date = $('#min_max_apmc_from_date').val();
	var to_date =$('#min_max_apmc_to_date').val();
$.ajax({
	    type: 'POST',
	    url: baseUrl+'Liveprice_ctrl/states_name_live',
	    dataType: "json",
	    data: 
	    {
	    	'fromDate' : from_date,
	 		'toDate' : to_date
	    },
	    beforeSend: function(){
	    },
	    complete: function(){},
		success:function (response) {
			if(response.status == 200){
				var x = '<option value="">-- Select State --</option>;<option value="">-- All --</option>';
				$.each(response.data,function(key,value){

					if (value.min_price != 0 && value.modal_price != 0 && value.max_price != 0 ) {
					x = x + '<option value="'+ value.state +'">'+ value.state +'</option>';
					}

				});
				$('#min_max_state').html(x);
			}
		}
});
$(document).on('change','#min_max_no_of_list',function(){
	var value = $(this).val();
	pagination(value);
});

$(document).on('change','#min_max_state',function(){
	fetch_table_data();
	$('#min_max_no_of_list').val(start);
});

var start = 0;
var limit = 10;
var data_array = [];

function fetch_table_data(){
	var stateName = $("#min_max_state option:selected").text();
	var from_date = $('#min_max_apmc_from_date').val();
	var to_date =$('#min_max_apmc_to_date').val();
	
	$.ajax({
	    type: 'POST',
	    url: baseUrl+'Liveprice_ctrl/trade_data_list',
	    dataType: "json",
	    data: {
	    	'language' : 'en',
	    	'stateName' : stateName,
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
	for(var i = parseInt(parseInt(start*limit)+slug); i <= (parseInt(parseInt(parseInt(start)*10))+5000); i++){
		if(i < array_length){

				if (data_array[i].min_price != 0 && data_array[i].modal_price != 0 && data_array[i].max_price != 0 ) 
				{

					//new added
					//$('#table_mandi_from_date').html(formatDateTime(data_array[i].created_at));

					x = x + '<tr>'+
					// '<td align="center" style="text-align:center;">'+ data_array[i].state +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array[i].apmc +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array[i].commodity +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].min_price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].modal_price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].max_price) +'</td>';
					// '<td align="center" style="text-align:center;">'+ number_formate(data_array[i].commodity_arrivals) +'</td>'+
					// '<td align="center" style="text-align:center;">'+ number_formate(data_array[i].commodity_traded) +'</td>'+
					// '<td align="center" style="text-align:center;">'+ data_array[i].Commodity_Uom +'</td>'+
					// '<td align="center" style="text-align:center;">'+ formatDate(data_array[i].created_at) +'</td>';
					x = x + '</tr>';  

				}
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

 function formatDateTime(date) {
     var d = new Date(date),
         month = '' + (d.getMonth() + 1),
         day = '' + d.getDate(),
         year = d.getFullYear();
         hours = d.getHours();
         minute = d.getMinutes();
         second = d.getSeconds();

     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

    const dateString = "" + day + "-" + month + "-" + year;
    const timeString = "" + hours + ":" + minute + ":" + second;
    const datec = dateString + " , " + timeString;

     return datec;
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

<!-- commodity wise -->
<script type="text/javascript">
		$('#min_max_apmc_from_date_1').on('keydown', function(event) {
		console.log(event);
	    if (event.keyIdentifier == "Down") {
	        event.preventDefault()
	    }
	}, false);

	$('#min_max_apmc_to_date_1').on('keydown', function(event) {
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

$('#min_max_apmc_from_date_1').val($('#previous_date_1').val());
$('#min_max_apmc_to_date_1').val($('#previous_date_1').val());

//////////////fetch state////////////////////////////////////
	var from_date = $('#min_max_apmc_from_date_1').val();
	var to_date =$('#min_max_apmc_to_date_1').val();
$.ajax({
	    type: 'POST',
	    url: baseUrl+'Liveprice_ctrl/commodity_names',
	    dataType: "json",
	    data: 
	    {
	    	'fromDate' : from_date,
	 		'toDate' : to_date
	    },
	    beforeSend: function(){
	    },
	    complete: function(){},
		success:function (response) {
			if(response.status == 200){
				var x = '<option value="">-- Select Commodity --</option>;<option value="">-- All --</option>';
				$.each(response.data,function(key,value){

					if (value.min_price != 0 && value.modal_price != 0 && value.max_price != 0 ) {
					x = x + '<option value="'+ value.commodity +'">'+ value.commodity +'</option>';
					}
				});
				$('#min_max_commodity').html(x);
			}
		}
});
$(document).on('change','#min_max_no_of_list_1',function(){
	var value = $(this).val();
	pagination_1(value);
});

$(document).on('change','#min_max_commodity',function(){
	fetch_table_data_1();
	$('#min_max_no_of_list_1').val(start_1);
});

var start_1 = 0;
var limit_1 = 10;
var data_array_1 = [];

function fetch_table_data_1(){
	var commodity = $("#min_max_commodity option:selected").text();
	var from_date = $('#min_max_apmc_from_date').val();
	var to_date =$('#min_max_apmc_to_date').val();
	
	$.ajax({
	    type: 'POST',
	    url: baseUrl+'Liveprice_ctrl/trade_data_list_1',
	    dataType: "json",
	    data: {
	    	'language' : 'en',
	    	'commodity' : commodity,
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
	    		var pages = parseInt(parseInt(array_length_1)/parseInt(limit));
	    		var y = '';
	    		for(var i = 0;i<= pages; i++){
	        		y = y + '<option value="'+ i +'">'+ parseInt(parseInt(i)+1) +'</option>';
	    		}
	    		$('#min_max_no_of_list_1').html(y);
	    		pagination_1(start_1);
			}
			else{
				$('#data_list_1').html('<tr><td colspan="11" style="text-align:center;">No record Found.</td></tr>');					
			}
			console.log(response);
		}
	});
	
	$('#mandi_from_date_1').html(formatDate($('#min_max_apmc_from_date_1').val()));
	$('#mandi_to_date_1').html(formatDate($('#min_max_apmc_to_date_1').val()));
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
	var x = '';
	for(var i = parseInt(parseInt(start_1*limit_1)+slug_1); i <= (parseInt(parseInt(parseInt(start_1)*10))+5000); i++){
		if(i < array_length_1){

			if (data_array_1[i].min_price != 0 && data_array_1[i].modal_price != 0 && data_array_1[i].max_price != 0 ) 
				{
			x = x + '<tr>'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].state +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].apmc +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].commodity +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].min_price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].modal_price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].max_price) +'</td>';
					// '<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].commodity_arrivals) +'</td>'+
					// '<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].commodity_traded) +'</td>'+
					// '<td align="center" style="text-align:center;">'+ data_array_1[i].Commodity_Uom +'</td>'+
					// '<td align="center" style="text-align:center;">'+ formatDate(data_array_1[i].created_at) +'</td>';
				x = x + '</tr>';  
			}
		}
		else{
    		break;
		}
	} 
	$('#data_list_1').html(x);
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

//////////////////////////////////////////////////////////////////
if((typeof($('#apmc_id_param').val()) != "undefined" && $('#apmc_id_param').val() !== 'null') && (typeof($('#apmc_id_param').val()) != "0" && $('#apmc_id_param').val() !== '0')){
	setTimeout(function(){
	console.log('first time function call');
	  var commodity = $('#commodity_id_param').val();
	  $('#min_max_commodity').val(commodity);
	  $('#min_max_commodity').trigger('change');
	}, 3000);

	setTimeout(function(){
	console.log('second time function call');
	  commodity_list();
	  $('#refresh').trigger('click');
	}, 5000);
}
else{
	fetch_table_data_1();
}



</script>