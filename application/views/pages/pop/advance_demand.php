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
			<div class="col-md-12 bc-nav" >
				<a href="<?php echo base_url(); ?>" title=""><?php echo $this->lang_file->heading_fetch('home');?></a>&nbsp;<i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
				<a href="<?php echo base_url(); ?>pop-dashboard"><?php echo $this->lang_file->heading_fetch('pop_dashboard');?> </a><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
				<a href="<?php echo base_url(); ?>pop-dashboard/trading-platforms"><?php echo $this->lang_file->heading_fetch('trading_platform');?> </a><i class="fa fa-angle-right"></i><i class="fa fa-angle-right"></i>&nbsp;
				<?php echo $this->lang_file->heading_fetch('advance_demand');?>
			</div>
			<?php date_default_timezone_set("Asia/Kolkata");
				$date = date("Y-m-d");
			?>

			<div class="col-sm-9 content-9 h-space-padd-r" >
				<h3 class="p-title"><span><?php echo $this->lang_file->heading_fetch('advance_demand');?><p class="t-stake-data"><a id="backBtn"><b><?php echo $this->lang_file->heading_fetch('back');?></b>  <img src="<?php echo base_url(); ?>assest/images/pop/back-arrow.png" style="width: 20px;"></a></p></span></h3>
				
				<div class="col-sm-12 well e-trade-detail-box" >
					<div class="col-md-3 emandi-select e-trade-inputs" style="padding-left: 26px;padding-right: 1px;">
						<b>From Date </b><span style="color:#F00;">*</span>
						<input type="date" class="form-control" name="fromDate" id="fromDate" value="<?php echo date("Y-m-d")?>" min="<?php echo date("Y-m-d"); ?>">
					</div>

					<div class="col-md-2 emandi-select e-trade-inputs" style="padding-left: 31px;padding-right: 0px">
						<b>To Date </b><span style="color:#F00;">*</span>
						<input type="date" class="form-control" name="toDate" id="toDate" value="<?php echo date("Y-m-d")?>" min="<?php echo date("Y-m-d"); ?>">
					</div>

					<div class="col-md-3 emandi-select e-trade-inputs" style="padding-left: 33px;padding-right: 0px;">
						<b><?php echo $this->lang_file->heading_fetch('min_max_commodity');?></b>
						<select class="form-control" id="demand_commo" name="demand_commo">
							<option value="">Select Commodity</option>
						</select>
					</div>

					<div class="col-md-2 emandi-select e-trade-inputs" style="padding-left: 34px;padding-right: 0px">
						<b><?php echo $this->lang_file->heading_fetch('min_max_state');?></b>
						<select class="form-control" id="demand_state" name="demand_state">
							<option value="">--All--</option>
						</select>
					</div>

					<div style="padding-left: 71px;" class="col-md-2 ">
						<button class="btn btn-primary" id="submitbtn" style="margin-top:21px;">Search</button>
					</div>
				</div>

				<br><br><br>
				<div class="col-md-12 table-responsive" style="padding-left: 2px;padding-right: 0px;">	
					<table class="table table-striped table-bordered" id="platformtable">
						<thead>
							<tr>
								<th style="text-align:center;">Sr. No.</th>
								<th style="text-align:center;">Date</th>
								<th style="text-align:center;">Buyer Name</th>
								<th style="text-align:center;">Buyer Location</th>
								<th style="text-align:center;">Buyer State</th>
								<th style="text-align:center;">Platform Name</th>
								<th style="text-align:center;">Total Demand Count</th>
								<th style="text-align:center;">View Details</th>
							</tr>
						</thead>

						<tbody class="tbody" id="demand_data">
										
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-sm-3 content-3 h-space-padd-r-l">
				<div class="focus-section">
					<div class="sidebar-header-title"><span><?php echo $this->lang_file->heading_fetch('enam_coverage'); ?></span></div>
					<div class="home-ind-map">
						<a href="javascript:void(0);"><img src="<?php echo base_url();?>/assest/images/new-theme/map.jpg" usemap="#image-map" class="state_district"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Modal for view details -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  	<div class="modal-dialog modal-dialog-centered" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLongTitle">More Details</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
	      	</div>
	      	<div class="modal-body">
				<table class="table table-striped table-bordered" id="view_details">
					<thead>
						<tr>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">Sr. No.</th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">Commodity Name</th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">Location</th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">Demand Date</th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">Quantity</th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">Quantity UOM</th>
							<th rowspan="2" style="padding-bottom:2.5%;text-align:center;">Grade</th>
						</tr>
					</thead>

					<tbody class="tbody">
					
					</tbody>
				</table>	
	      	</div>
    	</div>
  	</div>
</div>

<div id="loader"></div>



<script type="text/javascript">
	$('#backBtn').click(function(){
		parent.history.back();
	});


	var spinner = $('#loader');
	let startDate = document.getElementById('fromDate').value;
	let endDate = document.getElementById('toDate').value;		
	getCommodity(startDate,endDate);


	$('#demand_commo').change(function(){
		let startDate = document.getElementById('fromDate').value;
		let endDate = document.getElementById('toDate').value;
		let commoName =  $("#demand_commo option:selected" ).text();
		$.ajax({
			url :  '<?php echo base_url();?>/Enam_ctrl/forGetAdvanceDemandState',
			type : 'POST',
			data : {
				startDate:startDate,
				endDate:endDate,
				commoName:commoName
			},
			dataType : 'json',
			success : function (response){
				console.log('check response',response);
				if(response.status == "Success"){
					if(response.data.length > 0){
						let x = '<option value="">--All--</option>';
						for(let data of response.data){
							x+=`<option value=${data.state}>${data.state}</option>`
						}
						$('#demand_state').html(x)
					}
				}
			}
		});
	});


	$(document).on('change','#fromDate,#toDate',function(){
		let startDate = document.getElementById('fromDate').value;
		let endDate = document.getElementById('toDate').value;
		getCommodity(startDate,endDate);
	});


	$(document).on('click','#submitbtn',function(){
		spinner.show();
		let fromDate = $("#fromDate").val();
		let toDate = $("#toDate").val();
		let stateName =  $("#demand_state option:selected" ).text();
		let commodityName =  $("#demand_commo option:selected" ).text();

		let state = stateName === '--All--' ? '' : stateName;
		let comm = commodityName === 'Select Commodity' ? '' : commodityName;

		var settings = {
		  	"url": "https://enam.gov.in/pop/rest/get_all_demand_mst",
		  	"method": "POST",
		  	"timeout": 0,
		  	"headers": {
		   	 	"Content-Type": "application/json",
		    	"Cookie": "JSESSIONID=151F0B3A5B11C34512C8582FE0D1C2C7; SERVERID=node34"
		  	},
		  	"data": JSON.stringify({
		    	"fromDate": `${fromDate}`,
		    	"state": `${state}`,
		    	"toDate": `${toDate}`,
		    	"commodityid": `${comm}`
		 	}),
		};

		$.ajax(settings).done(function (response) {
		  
			let resData =response;
			let i = 1;
			let t = 0;
			var tempArr = [];
			let tableData = '';

			let checkEmpty = Object.keys(resData.data).length === 0 && resData.data.constructor === Object;

			if(checkEmpty){
				spinner.hide();
				$('#platformtable tbody').html('<tr><td colspan="11" style="text-align:center;">No record Found.</td></tr>');
			}else{
				spinner.hide();
				//$('#no_data').css('display','none');
				//$('#platformtable').css('display','block');
				for(let data of resData.data.popbuyerdemandmstlist){
					//console.log('to check date', data);
					tempArr.push(data.popbuyerdemanddtl);
					tableData+=`<tr>
								<td>${i++}</td>
								<td>${data.createdon.substring(0, data.createdon.indexOf(' '))}</td>
								<td>${data.buyername}</td>
								<td>${data.buyerlocation}</td>
								<td>${data.buyerstate}</td>
								<td>${data.platformname}</td>
								<td>${data.popbuyerdemanddtl.length}</td>
								<td><button class='btn btn-info btn-sm v-id' data-id="${data.popbuyerdemandmstid}" data-tid=${t++} data-toggle="modal" data-target="#exampleModalCenter">View Details</button></td>
							</tr>`;
				}

				$('#platformtable tbody').html(tableData);

				$(document).on('click','.v-id', function(){ 
					let j = 1;
					let viewData = '';
					let variId = $(this).data("id");
					let refId = $(this).data("tid");
					for (let test of tempArr[refId]) {
						viewData+=`<tr>
									<td>${j++}</td>
									<td>${test.commodity}</td>
									<td>${test.location}</td>
									<td>${test.demandon}</td>
									<td>${test.qty}</td>
									<td>${test.qtyuomdesc}</td>
									<td>${test.grade}</td>
								</tr>`;
					}
					$('#view_details tbody').html(viewData);
				});
			}
		});
	});

	function getCommodity(startDate, endDate){
		$.ajax({
			url :  '<?php echo base_url();?>/Enam_ctrl/getAdvanceDemandCommodity',
			type : 'POST',
			data : {
				startDate:startDate,
				endDate:endDate
			},
			dataType : 'json',
			success : function (response){
				if(response.status == "Success"){
					let x = '<option value="">Select Commodity</option>';
					for(let data of response.data){
						x+=`<option value=${data.commodityid}>${data.commodity}</option>`
					}
					$('#demand_commo').html(x)
				}else{
				}
			}
		});
	}

	function convertDate(givenDate){
		let check = givenDate.split('-');
		let formateDate = `${check[2]}/${check[1]}/${check[0]}`;
		return formateDate;
	}




</script>

