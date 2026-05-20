<?php $group = $this->session->userdata('group_name'); ?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<ol class="breadcrumb">
		<li>
			<a title="Home" href="
				<?php echo base_url();?>admin/admin">
				<i class="fa fa-dashboard"></i> Home
			</a>
		</li>
		<li class="active">Mandi Contact Details</li>
	</ol>
	<section class="content-header">
		<h1 class="pull-left">Mandi Contact Details</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-12 connectedSortable">
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Import Excel Data of Mandi Contact Details</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i>
							</button>
						</div>
					</div>
					<form name="video_form" id="import_form" role="form" class="form-horizontal" method="POST">
            			<div class="box-body">
            				<div class="form-group">
            					<label class="col-sm-2 control-label">Select Excel File</label>
            					<div class="col-sm-3">
            						<input type="file" name="file" id="file" class="form-control" accept=".xls, .xlsx" />
            						<div class="text-danger" id="from_date_error" style="display:none;"></div>
            					</div>
            				</div>
            			 </div>
                		<div class="box-footer">
        					<button id="import" type="button" class="btn pull-right btn-info">Import</button>
        					<button type="reset" class="btn btn-default pull-right btn-space">Cancel</button>
        					<a href="<?php echo base_url(); ?>docs/mandi_address.xlsx" style="margin-right:10px;" class="btn btn-primary pull-right">Sample Data</a>
        				</div>	
					</form>
					<br />
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Sr. No.</th>
									<th>State</th>
									<th>District</th>
									<th>Mandi Name</th>
									<th>Address</th>
									<th>Contact Details</th>
									<th>Commodity Details</th>
								</tr>
							</thead>
							<tbody id="customer_data"></tbody>
						</table>
													<!-- Paginate -->
	<div style='margin-top: 10px;' id='pagination' class="pull-right"></div>
					</div>
				</div>
			</div>
		</section>
	</div>


<script type="text/javascript">
 
 //---------- Detect pagination click------------------------
	$('#pagination').on('click','a',function(e){
		e.preventDefault(); 
		var pageno = $(this).attr('data-ci-pagination-page');
		load_data(pageno);
	});

	load_data(0);
	//------------- Load pagination-----------------------------
	function load_data(pagno){
		$.ajax({
			url: '<?=base_url()?>admin/Excel_import/allList/'+pagno,
			type: 'get',
			dataType: 'json',
			success: function(response){
				if(response.status == 200){
					$('#pagination').html(response.result.pagination);
					var x = '';
					var i = ((parseInt(1) * parseInt(response.result.row)) + parseInt(1));
						$.each(response.result.result, function(key,value){
    						x = x + '<tr>'+
    								'<td>'+ i +'</td>'+
    								'<td>'+value.state+'</td>'+
    								'<td>'+value.district+'</td>'+
    								'<td>'+value.mandi_name+'</td>'+
    								'<td>'+value.address+'</td>'+
    								'<td>'+value.contact_details+'</td>'+
    								'<td>'+value.commodity_details+'</td>'+
    								'<tr>';
    							i++;
    						});
    					$('#customer_data').html(x);
						}else{
						$('#chalan_list').html('<tr><td class="text-center" colspan="7"><b>Search result not match</b></td></tr>');
						}
				}
		});
	}
	
$(document).on('click','#import', function(){

	var formdata = new FormData();
	formdata.append('file',$('#file')[0].files[0]);

	$.ajax({
		method:"POST",
		url:"<?php echo base_url(); ?>admin/Excel_import/import",
		dataType:'json',
		data:formdata,
                beforeSend: function(){
	        	$('#loader').modal({'show':true});	
	        },
		success:function(response){
	        	$('#loader').modal('hide');
		    if(response.status == 200){
			    alert(response.msg);
			    location.reload();
			    }else{
			    	alert(response.msg);
				    }
		 },
	    contentType:false,
	    cache:false,
	    processData:false,
		});
});






 

</script>