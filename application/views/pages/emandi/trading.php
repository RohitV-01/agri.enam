<?php date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
?>
 
<div class="container-fuild" style="float:left;width:100%;background-color:#eee;padding:10px 0% 12px 0%;">
<div class="container"><?php print_r($slider); ?></div>
</div>
 

<div class="container-fuild content-section" style="padding-top:10px;float:left;width:100%;padding-bottom:15px;">
<div class="container">
<div class="col-md-12 bc-nav" ><a href="<?php echo base_url(); ?>" title="">Home</a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;<a href="<?php echo base_url(); ?>eNam-mandi-status">eNAM Mandis</a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;Trading Details</div>
	<div class="col-sm-9 content-9 h-space-padd-r" >

<h3 class="p-title"><span>eNam Mandi Trading Details</span></h3>
			<div class="col-md-12 well e-trade-detail-box">
				<div class="col-md-2 e-trade-state-img">
					<img alt="" src="<?php echo base_url(); ?>assest/images/select-state.gif" />
				</div>
				<div class="col-md-2 e-trade-select-state" ><select class="form-control" id="min_max_state">
					<option value="0">-- All --</option>
				</select></div>
		<!-- 		
				<div class="col-md-3 e-trade-select-dist"><select class="form-control" id="today_district">
					<option value="0">-- Select District --</option>
				</select></div> -->
				
				<div class="col-md-3 e-trade-select-dist">
					<select class="form-control" id="min_max_apmc">
						<option value="0">-- Select APMCs --</option>
					</select>
				</div>


				<div class="col-md-3 e-trade-select-apmc">
					<select class="form-control" id="min_max_commodity">
						<option value="0">-- Select Commodity --</option>
					</select>
				</div>
				
				<div class="col-md-2 e-trade-select-date emandi-select"><input class="form-control" type="date" id="min_max_apmc_from_date" min="<?php echo date('Y-m-d', strtotime($date .' -7 day'));?>" value="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>"  max="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>" /></div>
				<div class="col-md-2 e-trade-select-date1 emandi-select"><input class="form-control" type="date" id="min_max_apmc_to_date" min="<?php echo date('Y-m-d', strtotime($date .' -7 day'));?>" value="<?php echo date('Y-m-d', strtotime($date .' -1 day')); ?>" max="<?php echo $date;?>" /></div>

				<div class="col-md-3 e-trade-refesh-btn">
					<input type="button" id="today_mandi_refresh" class="btn btn-refresh pull-left" value="Refresh" />
				<span class="pull-left" id="analysis_text" style="display:block;"><a class="btn btn-sm btn-deta-Ana" id="detailed_analysis" href="javascript:void(0);">Detailed Analysis</a></span></div>
		</div>
		
		<div id="table_mandi" class="" style="display:none;">
			<table class="table table-striped table-bordered table-center-detail">
				<thead>
		<tr>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_state');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_apmcs');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_commodity');?></th>
            <th colspan="3" style="text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_per_quintal');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_commodity_arrivals');
			?></th>
			<!-- <th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php //echo $this->lang_file->heading_fetch('min_max_commodity_arrival_qom');
			
			?></th> -->
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_commodity_traded');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('measurement_unit');?></th>
			<th rowspan="2" style="padding-bottom:2.5%;text-align:center;"><?php echo $this->lang_file->heading_fetch('min_max_date');?></th>
		</tr>
                <tr>
                        <th><?php echo $this->lang_file->heading_fetch('min_max_minprice');?></th>
			<th><?php echo $this->lang_file->heading_fetch('min_max_modalprice');?></th>
			<th><?php echo $this->lang_file->heading_fetch('min_max_maxprice');?></th>
                </tr>
	</thead>
			<tbody class="tbodya" id="mandi_table"></tbody>
			</table>
			
		</div>
	</div>

	<div class="col-sm-3 content-3 h-space-padd-r-l">
		<div class="focus-section">
			<div class="sidebar-header-title"><span><?php echo $this->lang_file->heading_fetch('enam_coverage'); ?></span></div>
				<div class="home-ind-map">
					<a href="javascript:void(0);"><img alt="" src="<?php echo base_url();?>/assest/images/new-theme/map.jpg" usemap="#image-map" class="state_district"></a>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<input type="hidden" id="previous_date" value="<?php echo date('Y-m-d', strtotime($date .' -1 day'));?>" />
<input type="hidden" id="current_date" value="<?php echo $date;?>" />

<script type="text/javascript">
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


var baseUrl = $('#base_url').val();
	$.ajax({	
	        type: 'POST',
	        url: baseUrl+'Ajax_ctrl/states_name',
	        dataType: "json",
	        data: {},
	        beforeSend: function(){},
	        complete: function(){},
	        success:function (response) {
				check_function();
	        	if(response.status == 200){
					var x = '<option value="0">-- All --</option>';
					$.each(response.data,function(key,value){
						x = x + '<option value="'+ value.state_id +'">'+ value.state_name +'</option>';
					});
					$('#min_max_state').html(x);
				}
				else{
				}
	        }
		});


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


/*	$(document).on('change','#today_states',function(){
		var state_id = $("#today_states option:selected").text();
		if(state_id == '-- All --'){
			fetch_table_data();
			return false;
		}
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'Ajax_ctrl/district_name_detail',
	        dataType: "json",
	        data: {
				'state_id' : state_id
			},
	        beforeSend: function(){
				$('#today_district').html('<option value="0">-- Select District --</option>');
				$('#today_mandi').html('<option value="0">-- Select APMCs --</option>');
				$('#table_mandi').css('display','none');
			},
	        complete: function(){},
	        success:function (response) {
	        	if(response.status == 200){
					var x = '<option value="0">-- Select District --</option>';
					$.each(response.data,function(key,value){
						x = x + '<option value="'+ value.district+'">'+ value.district.toUpperCase() +'</option>';
					});
					$('#today_district').html(x);
				}
				else{
					$('#loader').modal('toggle');
					alert('Record not found');
				}
			check_function();	
	        }
		});
	});
	*/
/*	
	$(document).on('change','#today_district',function(){
		var state_id = $("#today_states option:selected").text();
		var district_name = $("#today_district option:selected").text();
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'Ajax_ctrl/mandi_namedetail',
	        dataType: "json",
	        data: {
				'state_code' : state_id,
				'district' : district_name
			},
	        beforeSend: function(){
				$('#today_mandi').html('<option value="0">-- Select APMCs --</option>');
				$('#table_mandi').css('display','none');
			},
	        complete: function(){},
	        success:function (response) {
	        	if(response.status == 200){
					var x = '<option value="0">-- Select APMCs --</option>';
					$.each(response.data,function(key,value){
						x = x + '<option value="'+ value.mandi_name.toUpperCase() +'">'+ value.mandi_name.toUpperCase() +'</option>';
					});
					$('#today_mandi').html(x);
				}
				else{
				}
			check_function();
	        }
		});
	});*/
	
	
	$(document).on('change','#min_max_apmc',function(){
		//mandi_trade_list();
	});
	
	$(document).on('click','#today_mandi_refresh',function(){
		fetch_table_data();
      });

$(document).on('click','#detailed_analysis',function(){
	var today_states = $('#min_max_state').val();
	var today_mandi = $('#min_max_apmc').val();
	
	window.location.href = baseUrl+'dashboard/trade-data/'+today_states+'/'+today_mandi;
});
	  
function formatDate(date) {
     var d = new Date(date),
         month = '' + (d.getMonth() + 1),
         day = '' + d.getDate(),
         year = d.getFullYear();

     if (month.length < 2) month = '0' + month;
     if (day.length < 2) day = '0' + day;

     return [day, month, year].join('-');
 }

function check_function(){
	if($('#min_max_state').val() != 0){
		if($('#min_max_state').val() != 0){
			if($('#min_max_apmc').val() != 0){
				// $("#today_mandi_refresh").removeAttr("disabled");
				$("#analysis_text").css('display','block');
			}
			else{
				// $("#today_mandi_refresh").attr("disabled", "disabled");
				$("#analysis_text").css('display','block');
			}
		}
		else{
			// $("#today_mandi_refresh").attr("disabled", "disabled");
			$("#analysis_text").css('display','block');
		}
	}
	else{
		// $("#today_mandi_refresh").attr("disabled", "disabled");
		$("#analysis_text").css('display','block');
	}
}




fetch_table_data();
function fetch_table_data(){
    var stateName = $('#min_max_state option:selected').text();
	var apmcName = $('#min_max_apmc option:selected').text();
	var commodityName =  $("#min_max_commodity option:selected").text();
	var from_date = $('#min_max_apmc_from_date').val();
	var to_date = $('#min_max_apmc_to_date').val();

	$.ajax({
	    type: 'POST',
	    url: baseUrl+'Ajax_ctrl/trade_data_list',
	    dataType: "json",
	    data: {
	    	'language' : 'en',
	    	'stateName' : stateName,
	    	'apmcName' : apmcName,
            'commodityName' :commodityName,
	    	'fromDate' : from_date,
			'toDate' : to_date
	    },
	    beforeSend: function(){},
	    complete: function(){},
		success:function (response) {
                        var x = '';
			if(response.status == 200){
	    		$.each(response.data,function(key,value){
				   if(key < 5){
						x = x + '<tr>'+
						'<td align="center">'+ value.state +'</td>'+
						'<td align="center">'+ value.apmc +'</td>'+
						'<td align="center">'+ value.commodity +'</td>'+
						'<td align="center">'+ number_formate(value.min_price) +'</td>'+
						'<td align="center">'+ number_formate(value.modal_price) +'</td>'+
						'<td align="center">'+ number_formate(value.max_price) +'</td>'+
						'<td align="center">'+ number_formate(value.commodity_arrivals) +'</td>'+
						'<td align="center">'+ number_formate(value.commodity_traded) +'</td>'+
						'<td align="center">'+ value.Commodity_Uom +'</td>'+
						'<td align="center">'+ formatDate(value.created_at) +'</td>';
						x = x + '</tr>'; 
				   }
	    		});	
				$('#table_mandi').css('display','block');
				$('#mandi_table').html(x);
				
			}
			else{
				$('#table_mandi').css('display','block');
				$('#mandi_table').html('<tr><td style="text-align:center" colspan="10"><p class="text-center" style="text-align: center;">No records found.</p></td></tr>');					
			}
		}
	});
}
</script>