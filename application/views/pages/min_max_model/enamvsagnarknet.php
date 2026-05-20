
		<?php 
if(isset($param_state) && isset($param_apmc) && isset($param_commodity)){ ?>
  <input type="hidden" id="state_id_param" value="<?php echo $param_state; ?>">
  <input type="hidden" id="apmc_id_param" value="<?php echo $param_apmc; ?>">
  <input type="hidden" id="commodity_id_param" value="<?php echo $param_commodity; ?>">
<?php }?>
<!-- <div class="col-md-12" align="center" style="margin-bottom: 10px;">
	<label class="radio-inline"><input type="radio" name="feedoptions" onclick="show1()" checked value="SH"><strong>eNam</strong></label>
	<label class="radio-inline"><input type="radio" name="feedoptions" onclick="show2()" value="MS"><strong>Agmarknet</strong></label>
</div> -->
<section class="title-header-bg-apmc"></section>
<section class="container-fuild emandi-sec" >
<div class="container">
<div class="" style="margin-top:10px;">
<div class="col-md-12 bc-nav" ><a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;<span id="bredcrum1">&nbsp;
<a href="<?php echo base_url();?>dashboard"><?php echo $this->lang_file->heading_fetch('dashboard');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;<?php echo $this->lang_file->heading_fetch('min_max_manditrads');?></div>
<?php date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
?>
<div class="col-md-12" style="padding:0px;"><h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('eNAM_agmarknet');?></span></h3></div>


</div>
</section>

<div class="container">
<div class="row">
<!--      	<div class="col-md-12" align="center">
	<h4 style="color:red;"><b><?php //echo $this->lang_file->heading_fetch('eNAM_agmarknet');?></b>
		     </h4>      			
	</div>
		     --> 	
	<div class="col-md-7" align="right" style="padding-right: 0;">

		        <label class="radio-inline"><input type="radio" onclick="state_run()" name="colorRadio" value="green"> <b><?php echo $this->lang_file->heading_fetch('state_wise');?></b></label>
		        <label class="radio-inline"><input type="radio" onclick="commodity_run()" name="colorRadio" value="blue"> <b><?php echo $this->lang_file->heading_fetch('commodity_wise');?></b></label>
		     		</div>
	<div class="col-md-5" align="right">
		     			  	    <p><b> <?php echo $this->lang_file->heading_fetch('enam_data');?></b>: <button type="button" class="btn" style="width:60px;height: 25px;background-color: #A9D08E;"></button></p>
		     <p><b><?php echo $this->lang_file->heading_fetch('agm_data');?></b>: <button type="button" class="btn" style="width:60px;height: 25px;background-color: #BDD7EE;"></button></p>
		     		</div>
</div>
</div>



<section class="content-section container" id="enam_show" >
<?php date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
?>
<input type="hidden" id="previous_date" value="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>">
<input type="hidden" id="current_date" value="<?php echo $date;?>">

<?php date_default_timezone_set("Asia/Kolkata");
$date_1 = date("Y-m-d");
?>
<input type="hidden" id="previous_date_1" value="<?php echo date('Y-m-d', strtotime($date_1 .' -1 day'));?>">
<input type="hidden" id="current_date_1" value="<?php echo $date_1;?>">

<!-- <div class="col-md-12"><h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('enam_mandies_live');?></span></h3></div> -->
<!-- <div align="center">
	  <img src="<?php echo base_url();?>/assest/images/live-image-2.gif" alt="Chicago" style="height: 65px;">
</div> -->

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
<div class="col-md-5" align="right" style="margin-top: 5px;">
<b style="padding-top:25x"><?php echo $this->lang_file->heading_fetch('min_max_state');?>:</b>
</div>
<div  class="col-md-7" align="left">
<select class="form-control" id="min_max_state" style="width: auto;">
	<option value="">-- Select State --</option>
	<option value="">-- All --</option>
</select>
</div>

<div class="col-md-2 emandi-select e-trade-inputs1" style="display: none"><b><?php echo $this->lang_file->heading_fetch('min_max_from_date');?></b> <input class="form-control" type="hidden" id="min_max_apmc_from_date" min="<?php echo date('Y-m-d', strtotime($date .' -7 day'));?>" max="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>"/></div>
<div class="col-md-2 emandi-select e-trade-inputs1" style="display: none"><b><?php echo $this->lang_file->heading_fetch('min_max_to_date');?></b> <input class="form-control" type="hidden" id="min_max_apmc_to_date" min="<?php echo date('Y-m-d', strtotime($date .' -7 day'));?>" max="<?php echo $date;?>"/></div>


<div class="col-md-12">
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
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">eNAM / AGMARKNET</th>
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
	<tbody class="tbodya" id="data_list"></tbody>
</table>
</div>
</div>

<div class="row blue box" style="display: none">
<div class="col-md-5" align="right" style="margin-top: 5px;">
<b><?php echo $this->lang_file->heading_fetch('min_max_commodity');?>:</b>
</div>
<div  class="col-md-7" align="left">
<select class="form-control" id="min_max_commodity" style="width:auto;">
	<option value="">-- Select Commodity --</option>
	<option value="">-- All --</option>
</select>
</div>
<div class="col-md-2 emandi-select e-trade-inputs1" style="display: none"><b><?php echo $this->lang_file->heading_fetch('min_max_from_date');?></b> <input class="form-control" type="hidden" id="min_max_apmc_from_date_1" min="<?php echo date('Y-m-d', strtotime($date_1 .' -7 day'));?>" max="<?php echo date('Y-m-d', strtotime($date_1 .' -1 day'));?>"/></div>

<div class="col-md-2 emandi-select e-trade-inputs1" style="display: none"><b><?php echo $this->lang_file->heading_fetch('min_max_to_date');?></b> <input class="form-control" type="hidden" id="min_max_apmc_to_date_1" min="<?php echo date('Y-m-d', strtotime($date_1 .' -7 day'));?>" max="<?php echo $date_1;?>"/></div>

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
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">eNAM / AGMARKNET</th>
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
	<tbody class="tbodya" id="data_list_1"></tbody>
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

<style type="text/css">
	.bg_color1
	{
		background-color: #b0ce9c;
	}
	.bg_color2
	{
		background-color: #BDD7EE;
	}
	.bg_color3
	{
		background-color: #BDD7EE;
	}
</style>

<script type="text/javascript">
	var baseUrl = $('#base_url').val();
	current_date();
	function current_date(){
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'Agm_Enam_ctrl/current_date',
	        dataType: "json",
	        data: {
			},
	        beforeSend: function(){},
	        complete: function(){},
	        success:function (response) {
	        	if(response.status == 200){
						$.each(response.data,function(key,value){
							$('#table_mandi_from_date').html(formatDateTime(value.ndtd_trn_date));
							$('#table_mandi_from_date_1').html(formatDateTime(value.ndtd_trn_date));
						});
				}
	        }
		});
	}
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

function state_run()
{
		var from_date = $('#min_max_apmc_from_date').val();
	var to_date =$('#min_max_apmc_to_date').val();
$.ajax({
	    type: 'POST',
	    url:baseUrl+'Agm_Enam_ctrl/states_name_live',
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

					if (value.ndtd_Min_Price != 0 && value.ndtd_Max_Price != 0 && value.ndtd_Modal_Price != 0 ) {
					x = x + '<option value="'+ value.ndtd_State +'">'+ value.ndtd_State +'</option>';
					}

				});
				$('#min_max_state').html(x);
			}
		}
});

}


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
	    url: baseUrl+'Agm_Enam_ctrl/trade_data_list',
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

				if (data_array[i].ndtd_Min_Price != 0 && data_array[i].ndtd_Max_Price != 0 && data_array[i].ndtd_Modal_Price != 0 ) 
				{
					x = x + '<tr class="bg_color'+data_array[i].ndtd_Mandi_type+'">'+
					'<td align="center" style="text-align:center;">'+ data_array[i].ndtd_Mandi_type_desc +'</td>'+
					// '<td align="center" style="text-align:center;">'+ data_array[i].state +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array[i].ndtd_Mandi +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array[i].ndtd_Commodity +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].ndtd_Min_Price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].ndtd_Modal_Price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].ndtd_Max_Price) +'</td>';
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
    // const timeString = "" + hours + ":" + minute + ":" + second;
    // const datec = dateString + " , " + timeString;

     return dateString;
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

function commodity_run()
{
	var from_date = $('#min_max_apmc_from_date_1').val();
	var to_date =$('#min_max_apmc_to_date_1').val();
$.ajax({
	    type: 'POST',
	    url: baseUrl+'Agm_Enam_ctrl/commodity_names',
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

					if (value.ndtd_Min_Price != 0 && value.ndtd_Max_Price != 0 && value.ndtd_Modal_Price != 0 ) {
					x = x + '<option value="'+ value.ndtd_Commodity +'">'+ value.ndtd_Commodity +'</option>';
					}
				});
				$('#min_max_commodity').html(x);
			}
		}
});
}

	
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
	    url: baseUrl+'Agm_Enam_ctrl/trade_data_list_1',
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
	var y = '';
	for(var i = parseInt(parseInt(start_1*limit_1)+slug_1); i <= (parseInt(parseInt(parseInt(start_1)*10))+5000); i++){
		if(i < array_length_1){

			if (data_array_1[i].ndtd_Min_Price != 0 && data_array_1[i].ndtd_Modal_Price != 0 && data_array_1[i].ndtd_Max_Price != 0 ) 
				{
			y = y + '<tr class="bg_color'+data_array_1[i].ndtd_Mandi_type+'">'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].ndtd_Mandi_type_desc +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].ndtd_State +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].ndtd_Mandi +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].ndtd_Commodity +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].ndtd_Min_Price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].ndtd_Modal_Price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].ndtd_Max_Price) +'</td>';
					// '<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].commodity_arrivals) +'</td>'+
					// '<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].commodity_traded) +'</td>'+
					// '<td align="center" style="text-align:center;">'+ data_array_1[i].Commodity_Uom +'</td>'+
					// '<td align="center" style="text-align:center;">'+ formatDate(data_array_1[i].created_at) +'</td>';
				y = y + '</tr>';  
			}
		}
		else{
    		break;
		}
	} 
	$('#data_list_1').html(y);
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

<!-- popup -->

<style type="text/css">
#myModalbankdetail a.close{color:#f00;opacity:1;}
#myModalbankdetail h3{color:#f00;}
/*@media (max-width:1600px){
#myModalbankdetail{width: 1600px; height: 480px;}
}
@media (max-width:1400px){
#myModalbankdetail{width: 1400px; height: 480px;}
}

@media (max-width:1200px){
#myModalbankdetail{width: 1200px; height: 480px;}
}
@media (max-width:960px){
#myModalbankdetail{width: 700px; height: 480px;}
}

@media (max-width:585px){
#myModalbankdetail{width: 500px; height: 310px;}
}*/

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (max-width: 576px) 
{ 
	#myModalbankdetail{width: 600px; height: 480px;}
}

/* Medium devices (landscape tablets, 768px and up) */
 @media (min-width: 576px) and (max-width: 767px) 
{ 
	#myModalbankdetail{width: 767px; height: 480px;}
}

/* Large devices (laptops/desktops, 992px and up) */
 @media (min-width: 768px) and (max-width: 991px) 
{
	#myModalbankdetail{width: 991px; height: 480px;}
}

/* Extra large devices (large laptops and desktops, 1200px and up) */
   @media (min-width: 992px) and (max-width: 1199px) 
{
#myModalbankdetail{width: 1199px; height: 480px;}
}

</style>

<div class="modal fade" id="myModalbankdetail" style="
    background-color: #fff;
    margin:auto;
    left: 0;
    right: 0;
    border-radius: 23px;border:2px solid #7b7a7a;">
  <div class="modal-header text-center" style="padding-top: 5px;padding-bottom: 5px;">
    <a class="close" data-dismiss="modal">x</a>
     	<div class="row">
     		<div class="col-md-12" align="center">
		  <h4 style="color:red;"><b><?php echo $this->lang_file->heading_fetch('eNAM_agmarknet');?></b>
		     </h4>      			
		     		</div>
		     	
		     		<div class="col-md-7" align="right" style="padding-right:0">
		        <label class="radio-inline"><input type="radio" onclick="pop_state_run()" name="colorRadio" value="pop_green"> <b><?php echo $this->lang_file->heading_fetch('state_wise');?></b></label>
		        <label class="radio-inline"><input type="radio" onclick="pop_commodity_run()" name="colorRadio" value="pop_blue"> <b><?php echo $this->lang_file->heading_fetch('commodity_wise');?></b></label>
		     		</div>
		     		<div class="col-md-5" align="right">
		     			  	    <p><b> <?php echo $this->lang_file->heading_fetch('enam_data');?></b>: <button type="button" class="btn" style="width:60px;height: 25px;background-color: #A9D08E;"></button></p>
		     <p><b><?php echo $this->lang_file->heading_fetch('agm_data');?></b>: <button type="button" class="btn" style="width:60px;height: 25px;background-color: #BDD7EE;"></button></p>
		     		</div>
		     	</div>
		  </div>

	<div class="modal-body" style="padding-top: 5px;padding-bottom: 5px;height: 525px;overflow-y: auto;">
		<?php 
if(isset($param_state) && isset($param_apmc) && isset($param_commodity)){ ?>
  <input type="hidden" id="state_id_param" value="<?php echo $param_state; ?>">
  <input type="hidden" id="apmc_id_param" value="<?php echo $param_apmc; ?>">
  <input type="hidden" id="commodity_id_param" value="<?php echo $param_commodity; ?>">
<?php }?>
<!-- <div class="col-md-12" align="center" style="margin-bottom: 10px;">
	<label class="radio-inline"><input type="radio" name="feedoptions" onclick="show1()" checked value="SH"><strong>eNam</strong></label>
	<label class="radio-inline"><input type="radio" name="feedoptions" onclick="show2()" value="MS"><strong>Agmarknet</strong></label>
</div> -->
<section class="content-section" id="enam_show" >
<?php date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
?>
<input type="hidden" id="pop_previous_date" value="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>">
<input type="hidden" id="pop_current_date" value="<?php echo $date;?>">

<?php date_default_timezone_set("Asia/Kolkata");
$date_1 = date("Y-m-d");
?>
<input type="hidden" id="pop_previous_date_1" value="<?php echo date('Y-m-d', strtotime($date_1 .' -1 day'));?>">
<input type="hidden" id="pop_current_date_1" value="<?php echo $date_1;?>">

<!-- <div class="col-md-12"><h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('enam_mandies_live');?></span></h3></div> -->
<!-- <div align="center">
	  <img src="<?php echo base_url();?>/assest/images/live-image-2.gif" alt="Chicago" style="height: 65px;">
</div> -->

 <script>
		$(document).ready(function(){
		    $('input[type="radio"]').click(function(){
		        var inputValue = $(this).attr("value");
		        var targetBox = $("." + inputValue);
		        $(".pop_box").not(targetBox).hide();
		        $(targetBox).show();
		    });
		});
</script>

<div class="row pop_green pop_box " style="display: none">
<div class="col-md-5" align="right" style="margin-top: 5px;padding-right: 0;">
<b style="padding-top:25x"><?php echo $this->lang_file->heading_fetch('min_max_state');?>:</b>
</div>
<div class="col-md-7" align="left">
<select class="form-control" id="pop_min_max_state" style="width: auto;">
	<option value="">-- Select State --</option>
	<option value="">-- All --</option>
</select>
</div>

<div class="col-md-2 emandi-select e-trade-inputs1" style="display: none"><b><?php echo $this->lang_file->heading_fetch('min_max_from_date');?></b> <input class="form-control" type="hidden" id="pop_min_max_apmc_from_date" min="<?php echo date('Y-m-d', strtotime($date .' -7 day'));?>" max="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>"/></div>
<div class="col-md-2 emandi-select e-trade-inputs1" style="display: none"><b><?php echo $this->lang_file->heading_fetch('min_max_to_date');?></b> <input class="form-control" type="hidden" id="pop_min_max_apmc_to_date" min="<?php echo date('Y-m-d', strtotime($date .' -7 day'));?>" max="<?php echo $date;?>"/></div>


<div class="col-md-12">
<div class="pull-left" style="font-size:15px;" id="pop_mandi_content"><b>

<?php $date = date("Y-m-d"); ?>
<?php echo $this->lang_file->heading_fetch('min_max_trading_detail');?>: <span id="pop_table_mandi_from_date"></span></b>

</div>
<!-- <div class="pull-right"><b>Page:</b> <select class="form-control mandi-pagi" name="min_max_no_of_list" id="min_max_no_of_list"></select></div> -->
</div>
<div class="col-md-12 table-responsive">	
<table class="table table-bordered">
	<thead class="alert alert-success" style="background: #F2DEDE">
		<tr style="background: #F2DEDE">
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">eNAM / AGMARKNET</th>
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
	<tbody class="tbodya" id="pop_data_list"></tbody>
</table>
</div>
</div>

<div class="row pop_blue pop_box" style="display: none">
<div class="col-md-5" align="right" style="margin-top: 5px;padding-right: 0;">
<b><?php echo $this->lang_file->heading_fetch('min_max_commodity');?>:</b>
</div>
<div  class="col-md-7" align="left">
<select class="form-control" id="pop_min_max_commodity" style="width:auto;">
	<option value="">-- Select Commodity --</option>
	<option value="">-- All --</option>
</select>
</div>
<div class="col-md-2 emandi-select e-trade-inputs1" style="display: none"><b><?php echo $this->lang_file->heading_fetch('min_max_from_date');?></b> <input class="form-control" type="hidden" id="pop_min_max_apmc_from_date_1" min="<?php echo date('Y-m-d', strtotime($date_1 .' -7 day'));?>" max="<?php echo date('Y-m-d', strtotime($date_1 .' -1 day'));?>"/></div>

<div class="col-md-2 emandi-select e-trade-inputs1" style="display: none"><b><?php echo $this->lang_file->heading_fetch('min_max_to_date');?></b> <input class="form-control" type="hidden" id="pop_min_max_apmc_to_date_1" min="<?php echo date('Y-m-d', strtotime($date_1 .' -7 day'));?>" max="<?php echo $date_1;?>"/></div>

<div class="col-md-12" style="margin-top:15px;">
<div class="pull-left" style="font-size:15px;" id="pop_mandi_content"><b>

<?php $date = date("Y-m-d"); ?>
<?php echo $this->lang_file->heading_fetch('min_max_trading_detail');?>: <span id="pop_table_mandi_from_date_1"></span></b>

</div>
<!-- <div class="pull-right"><b>Page:</b> <select class="form-control mandi-pagi" name="min_max_no_of_list_1" 
	id="min_max_no_of_list_1"></select></div> -->
</div>
<div class="col-md-12 table-responsive">	
<table class="table table-bordered">
	<thead>
		<tr>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">eNAM / AGMARKNET</th>
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
	<tbody class="tbodya" id="pop_data_list_1"></tbody>
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

<style type="text/css">
	.bg_color1
	{
		background-color: #b0ce9c;
	}
	.bg_color2
	{
		background-color: #BDD7EE;
	}
	.bg_color3
	{
		background-color: #BDD7EE;
	}
</style>

<script type="text/javascript">
	var baseUrl = $('#base_url').val();
	pop_current_date();
	function pop_current_date(){
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'Agm_Enam_ctrl/current_date',
	        dataType: "json",
	        data: {
			},
	        beforeSend: function(){},
	        complete: function(){},
	        success:function (response) {
	        	if(response.status == 200){
						$.each(response.data,function(key,value){
							$('#pop_table_mandi_from_date').html(formatDateTime(value.ndtd_trn_date));
							$('#pop_table_mandi_from_date_1').html(formatDateTime(value.ndtd_trn_date));
						});
				}
	        }
		});
	}
</script>
<script type= "text/javascript">
	$('#pop_min_max_apmc_from_date').on('keydown', function(event) {
		console.log(event);
	    if (event.keyIdentifier == "Down") {
	        event.preventDefault()
	    }
	}, false);

	$('#pop_min_max_apmc_to_date').on('keydown', function(event) {
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

$('#pop_min_max_apmc_from_date').val($('#pop_previous_date').val());
$('#pop_min_max_apmc_to_date').val($('#pop_previous_date').val());

//////////////fetch state////////////////////////////////////

function pop_state_run()
{
		var from_date = $('#pop_min_max_apmc_from_date').val();
	var to_date =$('#pop_min_max_apmc_to_date').val();
$.ajax({
	    type: 'POST',
	    url:baseUrl+'Agm_Enam_ctrl/states_name_live',
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

					if (value.ndtd_Min_Price != 0 && value.ndtd_Max_Price != 0 && value.ndtd_Modal_Price != 0 ) {
					x = x + '<option value="'+ value.ndtd_State +'">'+ value.ndtd_State +'</option>';
					}

				});
				$('#pop_min_max_state').html(x);
			}
		}
});

}


$(document).on('change','#pop_min_max_no_of_list',function(){
	var value = $(this).val();
	pop_pagination(value);
});

$(document).on('change','#pop_min_max_state',function(){
	pop_fetch_table_data();
	$('#pop_min_max_no_of_list').val(start);
});

var start = 0;
var limit = 10;
var data_array = [];

function pop_fetch_table_data(){
	var stateName = $("#pop_min_max_state option:selected").text();
	var from_date = $('#pop_min_max_apmc_from_date').val();
	var to_date =$('#pop_min_max_apmc_to_date').val();
	
	$.ajax({
	    type: 'POST',
	    url: baseUrl+'Agm_Enam_ctrl/trade_data_list',
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
	    		$('#pop_min_max_no_of_list').html(y);
	    		pop_pagination(start);
			}
			else{
				$('#pop_data_list').html('<tr><td colspan="11" style="text-align:center;">No record Found.</td></tr>');					
			}
			console.log(response);
		}
	});
	
	$('#pop_mandi_from_date').html(formatDate($('#pop_min_max_apmc_from_date').val()));
	$('#pop_mandi_to_date').html(formatDate($('#pop_min_max_apmc_to_date').val()));
}
function pop_pagination(start){
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

				if (data_array[i].ndtd_Min_Price != 0 && data_array[i].ndtd_Max_Price != 0 && data_array[i].ndtd_Modal_Price != 0 ) 
				{
					x = x + '<tr class="bg_color'+data_array[i].ndtd_Mandi_type+'">'+
					'<td align="center" style="text-align:center;">'+ data_array[i].ndtd_Mandi_type_desc +'</td>'+
					// '<td align="center" style="text-align:center;">'+ data_array[i].state +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array[i].ndtd_Mandi +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array[i].ndtd_Commodity +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].ndtd_Min_Price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].ndtd_Modal_Price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array[i].ndtd_Max_Price) +'</td>';
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
	$('#pop_data_list').html(x);
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
    // const timeString = "" + hours + ":" + minute + ":" + second;
    // const datec = dateString + " , " + timeString;

     return dateString;
 }

//////////////////////////////////////////////////////////////////
if((typeof($('#apmc_id_param').val()) != "undefined" && $('#apmc_id_param').val() !== 'null') && (typeof($('#apmc_id_param').val()) != "0" && $('#apmc_id_param').val() !== '0')){
	setTimeout(function(){
	console.log('first time function call');
	  var state = $('#state_id_param').val();
	  $('#pop_min_max_state').val(state);
	  $('#pop_min_max_state').trigger('change');
	}, 3000);

	setTimeout(function(){
	console.log('second time function call');
	  commodity_list();
	  $('#refresh').trigger('click');
	}, 5000);
}
else{
	pop_fetch_table_data();
}

</script>

<!-- commodity wise -->
<script type="text/javascript">
		$('#pop_min_max_apmc_from_date_1').on('keydown', function(event) {
		console.log(event);
	    if (event.keyIdentifier == "Down") {
	        event.preventDefault()
	    }
	}, false);

	$('#pop_min_max_apmc_to_date_1').on('keydown', function(event) {
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

$('#pop_min_max_apmc_from_date_1').val($('#pop_previous_date_1').val());
$('#pop_min_max_apmc_to_date_1').val($('#pop_previous_date_1').val());

//////////////fetch state////////////////////////////////////

function pop_commodity_run()
{
	var from_date = $('#pop_min_max_apmc_from_date_1').val();
	var to_date =$('#pop_min_max_apmc_to_date_1').val();
$.ajax({
	    type: 'POST',
	    url: baseUrl+'Agm_Enam_ctrl/commodity_names',
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

					if (value.ndtd_Min_Price != 0 && value.ndtd_Max_Price != 0 && value.ndtd_Modal_Price != 0 ) {
					x = x + '<option value="'+ value.ndtd_Commodity +'">'+ value.ndtd_Commodity +'</option>';
					}
				});
				$('#pop_min_max_commodity').html(x);
			}
		}
});
}

	
$(document).on('change','#pop_min_max_no_of_list_1',function(){
	var value = $(this).val();
	pop_pagination_1(value);
});

$(document).on('change','#pop_min_max_commodity',function(){
	pop_fetch_table_data_1();
	$('#pop_min_max_no_of_list_1').val(start_1);
});

var start_1 = 0;
var limit_1 = 10;
var data_array_1 = [];

function pop_fetch_table_data_1(){
	var commodity = $("#pop_min_max_commodity option:selected").text();
	var from_date = $('#pop_min_max_apmc_from_date').val();
	var to_date =$('#pop_min_max_apmc_to_date').val();
	
	$.ajax({
	    type: 'POST',
	    url: baseUrl+'Agm_Enam_ctrl/trade_data_list_1',
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
	    		$('#pop_min_max_no_of_list_1').html(y);
	    		pop_pagination_1(start_1);
			}
			else{
				$('#pop_data_list_1').html('<tr><td colspan="11" style="text-align:center;">No record Found.</td></tr>');					
			}
			console.log(response);
		}
	});
	
	$('#pop_mandi_from_date_1').html(formatDate($('#pop_min_max_apmc_from_date_1').val()));
	$('#pop_mandi_to_date_1').html(formatDate($('#pop_min_max_apmc_to_date_1').val()));
}


function pop_pagination_1(start_1){
	var array_length_1 = data_array_1.length;
// console.log(data_array);
	if(start_1 != 0){
		slug_1 = 1;
		}
	else{
		slug_1 = 0;
	}
	var y = '';
	for(var i = parseInt(parseInt(start_1*limit_1)+slug_1); i <= (parseInt(parseInt(parseInt(start_1)*10))+5000); i++){
		if(i < array_length_1){

			if (data_array_1[i].ndtd_Min_Price != 0 && data_array_1[i].ndtd_Modal_Price != 0 && data_array_1[i].ndtd_Max_Price != 0 ) 
				{
			y = y + '<tr class="bg_color'+data_array_1[i].ndtd_Mandi_type+'">'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].ndtd_Mandi_type_desc +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].ndtd_State +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].ndtd_Mandi +'</td>'+
					'<td align="center" style="text-align:center;">'+ data_array_1[i].ndtd_Commodity +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].ndtd_Min_Price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].ndtd_Modal_Price) +'</td>'+
					'<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].ndtd_Max_Price) +'</td>';
					// '<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].commodity_arrivals) +'</td>'+
					// '<td align="center" style="text-align:center;">'+ number_formate(data_array_1[i].commodity_traded) +'</td>'+
					// '<td align="center" style="text-align:center;">'+ data_array_1[i].Commodity_Uom +'</td>'+
					// '<td align="center" style="text-align:center;">'+ formatDate(data_array_1[i].created_at) +'</td>';
				y = y + '</tr>';  
			}
		}
		else{
    		break;
		}
	} 
	$('#pop_data_list_1').html(y);
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
	  $('#pop_min_max_commodity').val(commodity);
	  $('#pop_min_max_commodity').trigger('change');
	}, 3000);

	setTimeout(function(){
	console.log('second time function call');
	  commodity_list();
	  $('#refresh').trigger('click');
	}, 5000);
}
else{
	pop_fetch_table_data_1();
}
</script>

</div>
</div>

<script type="text/javascript">
$(window).on('load',function(){
	$('#myModalbankdetail').modal('show');
});
</script>
