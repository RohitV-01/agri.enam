<?php 
if(isset($param_state) && isset($param_apmc)){ ?>
  <input type="hidden" id="state_id_param" value="<?php echo $param_state; ?>">
  <input type="hidden" id="apmc_id_param" value="<?php echo $param_apmc; ?>">
<?php }?>

<section class="title-header-bg-apmc"></section>
<section class="container-fuild" >
<div class="container">
<div class="" style="margin-top:20px;">
<div class="col-md-12 bc-nav" ><a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;<span id="bredcrum1">&nbsp;
<a href="<?php echo base_url();?>dashboard"><?php echo $this->lang_file->heading_fetch('dashboard');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp; ReMS</div>
<?php date_default_timezone_set("Asia/Kolkata");
$date = date("Y-m-d");
?>
<div class="col-md-12" style="padding:0px;"><h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('rems_price_dissemination');?></span></h3></div>
</section>
<!-- <script src="<?php //echo base_url();?>rems/js/jquery.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url();?>rems/js/jquery-ui.js"></script>
<script src="<?php echo base_url();?>rems/js/angular.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>rems/js/custom_angularjs.js"></script>
<style type="text/css">
	td, th {
    /* padding: 0; */
    width: 10%;
    background-color: white;
    border-style: groove;
</style>
<script>
	$(document).ready(
			  /* This is the function that will get executed after the DOM is fully loaded */
			  function () {
			    $( "#datepicker" ).datepicker({
				 dateFormat : 'dd/mm/yy',
				changeMonth: true,//this option for allowing user to select month
				      changeYear: true, //this option for allowing user to select from year range
				    
				});
			    
			    $( "#datepicker1" ).datepicker({
					  dateFormat : 'dd/mm/yy',
				      changeMonth: true,//this option for allowing user to select month
				      changeYear: true //this option for allowing user to select from year range
				    });
			  }

			);	
</script>

<section>
		<div class="content-section" style="margin-top: -40px">
		<div class="container" data-ng-app="maxApp">
			<div class="row">
				<div class="col-lg-12 col-sm-12">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<div class="commodity-list">
									<div data-ng-controller="filterCtrls">
											<div class="row well" style="padding: 5px;">
												<div class="col-md-2 emandi-select e-trade-inputs" style="padding-left:15px;">
													<b><?php echo $this->lang_file->heading_fetch('min_max_state');?></b>
													<select class="form-control" id="stateId" ng-model='state' ng-change="listChangeApmc()"
															data-ng-options='option.stateId as option.stateDesc for option in states'>
                                                       <!--  <option value="">All</option> -->                                                         
														</select>
												</div>

											<div class="col-md-2 emandi-select e-trade-inputs">
												<b><?php echo $this->lang_file->heading_fetch('min_max_apmcs');?></b>
													<select id="apmcNameId" ng-disabled="!state" class="form-control" ng-model='apmc' ng-change="listChange(apmc)"
																data-ng-options='option.apmcId as option.apmcDesc for option in apmsList'>
																<option value="">Select</option>
													</select>
											</div>

											<div class="col-md-2 emandi-select e-trade-inputs">
												<b><?php echo $this->lang_file->heading_fetch('min_max_commodity');?></b>
												
															<select id="commodityId" ng-disabled="!state" class="form-control" ng-model='commodity' ng-change="commodityValue(commodity)"
																data-ng-options='option.commidityId as option.commidityName for option in commodityList1'>
																<option value="">All</option>
															</select>
											</div>
											<div class="col-md-2 emandi-select e-trade-inputs1"><b><?php echo $this->lang_file->heading_fetch('min_max_from_date');?></b> 
													<input ng-model="fromDate" id="datepicker" readonly="readonly"
															class="form-control" type="text" >
											</div>


											<div style="margin-top: 20px" class="col-md-4 emandi-select e-trade-refresh-b">
													<button type="button" class="btn btn-refresh" ng-click="searchCommodity()"
																aria-label="Left Align" data-toggle="tooltip"
																data-placement="left" title="Refresh">
																Refresh
													</button>
											</div>
									</div>
									<style type="text/css">
								
									.table.table-wrapper {
									    border-collapse: collapse;
									    overflow-x: scroll;

									}
									#thead {
									    background-color: #EFEFEF;
									}
									#thead, #tbody {
									    display: block;
									}
									.tbodya {
									    overflow-y: scroll;
									    overflow-x: hidden;
									    height: 350px;
									}

									#td, #th {
									    min-width: 120px;
									    height: 25px;
									   
									    overflow:hidden;
									    text-overflow: ellipsis;
									    max-width: 117px;

									}	 
							
									</style>
									<div class="row" style="margin-left:-30px;margin-right:-30px">

														<div class="col-md-12 table-responsive" >
										
												<table class="table table-bordered table-wrapper" id="karnatakaGrid" align="center">
												  <thead id="thead">
												    <tr>
												      <th id="th" scope="col">Commodity</th>
												      <th id="th" scope="col">Max Price(Rs.)</th>
												      <th id="th" scope="col">Min Price(Rs.)</th>
												      <th id="th" scope="col">Modal Price(Rs.)</th>
												      <th id="th" scope="col">Sold(Qty)</th>
												      <th id="th" scope="col">Total Arrival(Qty)</th>
												      <th id="th" scope="col">Unit</th>
												    </tr>
												  </thead>


												  <tbody id="tbody" class="tbodya">
												    <tr  ng-repeat="x in commodityGrid">
												    
												      <td id="td" style="text-align: center;">{{ x.commodity }}</td>
												      <td id="td" style="text-align: center;">{{ x.maxPrice.toFixed(2) }}</td>
												      <td id="td" style="text-align: center;">{{ x.minPrice.toFixed(2) }}</td>
												      <td id="td" style="text-align: center;">{{ x.modalPrice.toFixed(2) }}</td>
												      <td id="td" style="text-align: center;">{{ x.sold.toFixed(2) }}</td>
												      <td id="td" style="text-align: center;">{{ x.totalArrival.toFixed(2) }}</td>
												      <td id="td" style="text-align: center;">{{ x.uom }}</td>
												    </tr>


												    <tr ng-show="isTableShow" align="center">
								                              <td style="text-align: center;" colspan="{{(hidden) ?  22 : 19}}">
								                              Please Wait				                                  
					                                  		  </td>
													</tr>

												  </tbody>

												</table>



										</div>
									</div>
							</div>
						</div>
					</div>
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