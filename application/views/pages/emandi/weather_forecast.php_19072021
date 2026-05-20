<div class="container-fuild" style="float:left;width:100%;background-color:#eee;padding:10px 0% 12px 0%;">
<!-- <div class="container"><?php //print_r($slider); ?></div> -->
</div>


<div class="container-fuild content-section" style="padding-top:10px;float:left;width:100%;padding-bottom:15px;">
<div class="container">
<div class="col-md-12 bc-nav"><a href="<?php echo base_url(); ?>" title="">Home</a>&nbsp; <i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;  <a href="<?php echo base_url(); ?>weather_forecast">Weather Forecast</a>&nbsp; <i class="fa fa-angle-right"></i>
		</div>
<h3 class="p-title"><span>Weather Forecast</span></h3>
	<div class="col-sm-12  h-space-padd-r">
		
			<div class="col-md-12 well e-contact-detail-box">
				<div class="col-md-3 select-state-img">
				<img alt="" style="margin-top:-5px;" src="<?php echo base_url(); ?>/assest/images/select-state.gif" />
				</div>
				<div class="col-md-3 contact-select-state"><select class="form-control" id="today_states">
					<option value="0">Select State</option>
				</select></div>
			
				<!-- <div class="col-md-3 contact-select-dist"><select class="form-control col-md-4" id="today_district">
					<option value="0">Select District</option>
				</select></div> -->
				<div class="col-md-3 contact-select-dist" style=""><select class="form-control col-md-4" id="today_mandi">
					<option value="0">Select APMC's</option>
				</select></div>	
			</div>
	</div>
	
		<table class="table table-bordered table-striped" id="mandi_table" style="width: 82.5%">
                          <div id="table_top_statename" class="col-md-10" style="display:none;">
                          <div>	<b class="pull-left"><?php
							date_default_timezone_set("Asia/Kolkata");
								echo date("d-m-Y");
							?></b><span class="pull-right">Your search result for <b id="table_top_statename_text"></b></span></div>
							</b>
						   </div>
                </table>
		

		
<!-- 	<div class="col-sm-3 content-3 h-space-padd-r-l">
		<div class="focus-section">
			<div class="sidebar-header-title"><span><?php //echo $this->lang_file->heading_fetch('enam_coverage'); ?></span></div>
				<div class="home-ind-map">
					<a href="javascript:void(0);"><img alt="" src="<?php //echo base_url();?>/assest/images/new-theme/map.jpg" usemap="#image-map" class="state_district"></a>
				</div>
			</div>
		</div> -->
</div>
</div>

<script type="text/javascript">
var baseUrl = $('#base_url').val();
mandi_count();
	$.ajax({
	        type: 'POST',
	        url: baseUrl+'Weather_ctrl/state_namedetail',
	        dataType: "json",
	        data: {},
	        beforeSend: function(){},
	        complete: function(){},
	        success:function (response) {
	        	if(response.status == 200){
					var x = '<option>Select State</option>';
					$.each(response.data,function(key,value){
						x = x + '<option value="'+ value.wf_STATE_UT+'">'+ value.wf_STATE_UT+'</option>';
					});
					$('#today_states').html(x);
				}
				else{
				}
	        }
		});
		

	
	$(document).on('change','#today_states',function(){
		var state_id = $('#today_states').val();
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'Weather_ctrl/mandi_namedetail',
	        dataType: "json",
	        data: {
				'state_code' : state_id,
			},
	        beforeSend: function(){
				$('#today_mandi').html('<option value="0">Select APMC\'s</option>');
			},
	        complete: function(){},
	        success:function (response) {
			console.log(response);
	        	if(response.status == 200){
					var x = '<option>Select APMC\'s</option>';
					$.each(response.data,function(key,value){
						x = x + '<option value="'+ value.wf_APMC+'">'+ value.wf_APMC+'</option>';
					});
					$('#today_mandi').html(x);
				}
				else{
				}
	        }
		});
		mandi_count();
	});
	
	$(document).on('change','#today_mandi',function(){
		var state_name = $('#today_states').val();
		var mandi_id = $('#today_mandi').val();
		
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'Weather_ctrl/mandi_name',
	        dataType: "json",
	        data: {
				'mandi_id' : mandi_id,
                'state_name' : state_name,
			},
	        beforeSend: function(){},
	        complete: function(){},
	        success:function (response) {
	        	if(response.status == 200){
                    $('#table_top_statename_text').html(state_name);
                    $('#table_top_statename').css('display','block');
					var x = '<thead><tr><th colspan="2">Weather Forecast Details</th></tr></thead>'+
							'<tbody><tr><td style="width:25%;"><b>Mandi Name</b></td><td>'+ response.data[0].wf_APMC+'</td></tr>'+
							'<tr><td><b>State</b></td><td>'+ response.data[0].wf_STATE_UT+'</td></tr>'+
							'<tr><td><b>Max Temp (&#x2103;)</b></td><td>'+ response.data[0].wf_Max_Temp +'</td></tr>'+
							'<tr><td><b>Min temp  (&#x2103;)</b></td><td>'+ response.data[0].wf_Min_temp+'</td></tr>'+
							//'<tr><td><b>Email Address</b></td><td>'+ response.data[0].contact_details+'</td></tr>'+
							'<tr><td><b>Todays Forecast</b></td><td>'+ response.data[0].wf_Todays_Forecast +'</td></tr></tbody>';
					console.log(x);
				$('#mandi_table').html(x);	
					
				}
				else{
                $('#table_top_statename').css('display','none'); 
				$('#mandi_table').html('No record.');
				}
	        }
		});
		mandi_count();
	});	
	
	function mandi_count(){
		$.ajax({
	        type: 'POST',
	        url: baseUrl+'Weather_ctrl/mandi_count',
	        dataType: "json",
	        data: {
				'state' : $('#today_states').val(),
				'district' : $('#today_district').val(),
				'mandi' : $('#today_mandi').val(),
			},
	        beforeSend: function(){},
	        complete: function(){},
	        success:function (response) {
	        	if(response.status == 200){
					$('#contact_page_mandi_count_span').html(response.count);
				}
				else{
					$('#contact_page_mandi_count_span').html('1000');
				}
	        }
		});
	}
</script>
