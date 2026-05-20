<div class="container-fuild">
	<div class="container"><?php //print_r($slider); ?></div>
</div>
 
<div class="container-fuild content-section" style="padding-top:15px;float:left;width:100%;padding-bottom:15px;">
	<div class="container">
		<div class="col-md-12 bc-nav">
			<a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
			<a href="<?php echo base_url(); ?>pop-dashboard"><?php echo $this->lang_file->heading_fetch('pop_dashboard');?> </a><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
			<?php echo $this->lang_file->heading_fetch('pop_wdra');?></a>

		</div>
		<div class="col-sm-12 content-12 h-space-padd-r">

			<h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('wdra_full');?><p class="t-stake-data"><a id="backBtn"><b><?php echo $this->lang_file->heading_fetch('back');?></b>  <img src="<?php echo base_url(); ?>assest/images/pop/back-arrow.png" style="width: 20px;"></a></p></span></h3>
			
			<div class="col-sm-12">
				<div class="col-md-3 emandi-select e-trade-inputs" style="padding-left:15px;">
					<b><?php echo $this->lang_file->heading_fetch('min_max_state');?></b>
					<select class="form-control" id="pop_state">
						<option value="0">-- Select State --</option>
						<?php
						
						    foreach ($apiData as $result) {
							    if(is_array($result)){
							        foreach ($result as $car) { ?>
							            <option value="<?php echo $car['state'] ?>"><?php echo $car['state'] ?></option>
							  <?php      }
							    }
							}?>
						   			

						 ?>
					</select>
				</div>
				<div class="col-md-3 emandi-select e-trade-inputs">
					<b>District</b>
					<select class="form-control" id="pop_district">
						<option value="">-- Select District --</option>
					</select>
				</div>
				
				
				<div style="padding-right: 0;" class="col-md-2 emandi-select e-trade-refresh-b">
					<input style="margin-top:21px;" class="btn btn-refresh" type="button" value="Search" id="refresh">
				</div>
			</div>

			
			<div class="col-md-12 table-responsive" style="padding-top: 30px; padding-left: 30px;">	
				<table class="table table-striped table-bordered" id="table_data" style="display: none;">
					<thead>
						<tr>
							<th rowspan="2" style="padding-bottom:1%;text-align:center;">Sr No</th>
							<th rowspan="2" style="padding-bottom:1%;text-align:center;">WH Name</th>
							<th rowspan="2" style="padding-bottom:1%;text-align:center;width: 10%;">WH Address</th>
							<th rowspan="2" style="padding-bottom:1%;text-align:center;width: 10%;">WH Contact No.</th>

							<th rowspan="2" style="padding-bottom:1%;text-align:center;width: 10%;">WH Capacity</th>
							<th rowspan="2" style="padding-bottom:1%;text-align:center;width: 12%;">WH Available Capacity</th>
							<th rowspan="2" style="padding-bottom:1%;text-align:center;width: 10%;">WH Commodity</th>
							<th rowspan="2" style="padding-bottom:1%;text-align:center; width: 10%;">WH GPS</th>
							<th rowspan="2" style="padding-bottom:1%;text-align:center;width: 12%;">WH Registration Date</th>
				            <th rowspan="2" style="padding-bottom:1%;text-align:center;width: 12%;">Near By eNAM APMC</th>
							<th rowspan="2" style="padding-bottom:1%;text-align:center;">Status</th>
						
						</tr>
		                
					</thead>
					<tbody class="tbodya" id="data_list"></tbody>
				</table>
			</div>
		</div>			
	</div>
</div>
</div>

<script type="text/javascript">
	
		

	$('#backBtn').click(function(){
		parent.history.back();
	});

	$('#pop_state').change(function(){
		let stateValue = $(this).val();

		$.ajax({
			url: '<?php echo base_url();?>/Enam_ctrl/wdraDistrictData',
			method: 'POST',
			dataType:'json',
			data:{stateValue:stateValue},
			success:function(response){
				console.log(response);
				let x = '<option value="">-- Select District --</option>';
				var eachData = jQuery.parseJSON(response);
				$.each(eachData.data, function(key, item) 
				{
				   console.log(item.district);
				   x = x + '<option value="'+ item.district +'">'+ item.district +'</option>';;
				});

				$('#pop_district').html(x);

			}
		})
	});


	$('#refresh').click(function(){
		let state = $('#pop_state').val();
		let district = $('#pop_district').val();

		if(state == 0){
			alert('Please select state');
			return;
		}

		$.ajax({
			url:'<?php echo base_url();?>/Enam_ctrl/wdraresponse',
			method: 'POST',
			data:{
				state:state, district : district
			},
			dataType:'json',
			success:function(response){
				
				let i = 1;
				let tableData = '';
				if(response.stateData){
					$('#table_data').show();
					var eachData = jQuery.parseJSON(response.stateData);
					for(let data of eachData.data){
						console.log(data);
						tableData+=`<tr>
										<td>${i++}</td>
										<td>${data.whname}</td>
										<td>${data.whaddress1}</td>
										<td>${data.whcontactno}</td>
										<td>${data.capacity}</td>
										<td>${data.availablecapacity}</td>
										<td>${data.whcommodity}</td>
										<td>Latitude : ${data.latitude}<BR>
										Longitude : ${data.longitude}</td>
										<td>${data.whregistrationdate}</td>
										<td>${data.nearbyapmc}</td>
										<td>${data.status}</td>
									</tr>`;
					}
				}

				if(response.distData){
					$('#table_data').show();
					var eachData = jQuery.parseJSON(response.distData);
					for(let data of eachData.data){
							console.log(data);
						tableData+=`<tr>
										<td>${i++}</td>
										<td>${data.whname}</td>
										<td>${data.whaddress1}</td>
										<td>${data.whcontactno}</td>
										<td>${data.capacity}</td>
										<td>${data.availablecapacity}</td>
										<td>${data.whcommodity}</td>
										<td>Latitude : ${data.latitude} <BR>
										Longitude : ${data.longitude}</td>
										<td>${data.whregistrationdate}</td>
										<td>${data.nearbyapmc}</td>
										<td>${data.status}</td>
									</tr>`;
					}
				}
				
				$('#table_data tbody').html(tableData);

			}
		})




	})


</script>




