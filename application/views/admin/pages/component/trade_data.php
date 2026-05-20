<?php   $group = $this->session->userdata('group_name'); ?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<ol class="breadcrumb">
		<li>
			<a title="Home" href="
				<?php echo base_url();?>admin/admin">
				<i class="fa fa-dashboard"></i> Home
			</a>
		</li>
		<li class="active">Logg Details</li>
	</ol>
	<section class="content-header">
		<h1 class="pull-left">Trade data</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-12 connectedSortable">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Fetch Trade data</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<form name="video_form" id="import_form" role="form" class="form-horizontal" method="POST">
            			<div class="box-body">
            				<div class="form-group">
            					<label class="col-sm-2 control-label">Date</label>
            					<div class="col-sm-3">
            						<input type="date" name="from_date" id="from_date" class="form-control" value="<?php echo date('Y-m-d', strtotime(date('Y-m-d') .' -1 day')); ?>" max="<?php echo date('Y-m-d', strtotime(date('Y-m-d') .' -1 day')); ?>">
            						<div class="text-danger" id="from_date_error" style="display:none;"></div>
            					</div>
								<div>
									<input type="button" value="Fetch Record" id="fetch" class="btn btn-default">
									<input type="button" value="Update Database" id="update" class="btn btn-warning"> 
								</div>
            				</div>
            			 </div>
					</form>
				</div>
				<div class="">
					<table class="table">
						<thead>
						<tr>
							<th>S.no.</th>
							<th>ApmcName</th>
							<th>ArrivalQty</th>
							<th>CommodityName</th>
							<th>ListCommodity</th>
							<th>MaxPrice</th>
							<th>MinPrice</th>
							<th>ModelPrice</th>
							<th>SoldQty</th>
							<th>Unit</th>
							<th>StateName</th>
							<th>StatusMsg</th>
						</tr>
						</thead>
						<tbody id="tradedata">
							
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>


<script type="text/javascript">
var baseUrl = $('#base_url').val(); 
tradedata = [];


$(document).on('click','#fetch', function(){
	$.ajax({
		method:"POST",
		url:"https://enam.gov.in/NamWebSrv/rest/CommodityPrice/getMinMaxModelPrice",

		/*updated Webservice for Qunatity Unit*/
		/*url :"http://192.168.0.136:3333/NamWebSrv/rest/CommodityPrice/getMinMaxModelPrice",
*/		dataType:'json',
		data: {
			'commodityName' : 'null',
			'apmcName' : '',
			'stateName' : '',
			'language' : 'en',
			'fromDate' : $('#from_date').val() + ' 00:00:00',
			'toDate' : $('#from_date').val() + ' 23:59:59',
		},
		beforeSend: function(){
			$('#loader').modal('show');
			},
			complete: function(){},
		success:function(response){
			var x = '';
			console.log(response);
			if(response.statusMsg == 'S'){
				$('#loader').modal('toggle');
				tradedata = response;
				$.each(response.listCommodity,function(key,value){
					x = x + '<tr>'+
								'<td>'+ parseInt(parseInt(key)+1) +'</td>'+
								'<td>'+ value.apmcName +'</td>'+
								'<td>'+ value.arrivalQty +'</td>'+
								'<td>'+ value.commodityName +'</td>'+
								'<td>'+ value.listCommodity +'</td>'+
								'<td>'+ value.maxPrice +'</td>'+
								'<td>'+ value.minPrice +'</td>'+
								'<td>'+ value.modelPrice +'</td>'+
								'<td>'+ value.soldQty +'</td>'+
								'<td>'+ value.commodityUom +'</td>'+
								'<td>'+ value.stateName +'</td>'+
								'<td>'+ value.statusMsg +'</td>'+
							'</tr>';
				});
				$('#tradedata').html(x);
			}
		}
	});
});

$(document).on('click','#update',function(){

	$.ajax({
		method:"POST",
		url: baseUrl + 'Ajax_ctrl/trade_data_ajax_check',
		async : false,
		dataType:'json',
		data:{
			'date' : $('#from_date').val()
		},
        beforeSend: function(){                   
            $('#loader').modal({'show':true});	
        },
		success:function(response){
			$('#loader').modal('hide');
			if(response.status == 201){
				var c = confirm(response.msg);
				if(c){
					$.ajax({
						method:"POST",
						url: baseUrl + 'Ajax_ctrl/trade_data_ajax',
						dataType:'json',
						async : false,
						data:{
							'tradedata' : JSON.stringify(tradedata),
							'date' : $('#from_date').val()
						},
				                beforeSend: function(){                   
				                 	
				                },
						success:function(response){			
				                   alert(response.msg);
						}
					});
				}
			}
			else{
				$.ajax({
					method:"POST",
					url: baseUrl + 'Ajax_ctrl/trade_data_ajax',
					dataType:'json',
					async : false,
					data:{
						'tradedata' : JSON.stringify(tradedata),
						'date' : $('#from_date').val()
					},
			                beforeSend: function(){
			                	//$('#loader').modal({'show':true});
			                },
					success:function(response){	
							if(response.status == 200){	
							//$('#loader').modal('hide');	
			                   alert(response.msg);
							}
					}
				});
			}
		}
	});
});




 

</script>
